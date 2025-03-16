<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Driver;
use App\Models\Order;
use App\Notifications\DriverAssigned;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of orders for the authenticated driver.
     */
    public function index()
    {
        // Assuming your User model has a relationship "driver" to fetch the associated Driver record.
        $user = Auth::user();
        $driver = Driver::where('user_id', $user->id)->first();

        if (!$driver) {
            abort(404, 'Driver record not found for this user.');
        }

        // Get orders where driver_id equals the current driver's id
        $orders = Order::where('driver_id', $driver->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('driver.orders.index', compact('orders'));
    }

    /**
     * Display the specified order details.
     */
    public function show(Order $order)
    {
        $user = Auth::user();

        // Get all notifications (read + unread)
        $notification = $user->notifications() // Use notifications(), not unreadNotifications()
        ->where('type', DriverAssigned::class)
        ->whereJsonContains('data->order_id', $order->id)
        ->first();

        
        // Debugging: Check if we got the notification
        if (!$notification) {
            dd('No unread notification found for this order.');
        }
    
        // Mark the notification as read
        $notification->markAsRead();
    
        // Ensure the driver can access this order
        $driver = Driver::where('user_id', $user->id)->first();
        if ($order->driver_id !== $driver->id) {
            abort(403, 'Unauthorized access to order details.');
        }
    
        return view('driver.orders.show', compact('order'));
    }
    

    public function updateLocation(Request $request)
    {
        $data = $request->validate([
            'latitude'  => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $user = Auth::user();
        $driver = Driver::where('user_id', $user->id)->firstOrFail();
        $driver->update([
            'latitude'  => $data['latitude'],
            'longitude' => $data['longitude'],
        ]);

        return response()->json(['message' => 'Location updated successfully!']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // Load current order items and pass available users, drivers, and bricks for selection
        $order->load('orderItems');
        $users   = \App\Models\User::all();
        $drivers = \App\Models\Driver::all();
        $bricks  = \App\Models\Brick::all();
        return view('driver.orders.edit', compact('order', 'users', 'drivers', 'bricks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $data = $request->validated();

        // Remember old status
        $oldStatus = $order->order_status;

        // Update order record
        $order->update([
            'user_id'          => $data['user_id'],
            'driver_id'        => $data['driver_id'],
            'order_date'       => $data['order_date'],
            'total_amount'     => $data['total_amount'],
            'order_status'     => $data['order_status'],
            'shipping_address' => $data['shipping_address'],
        ]);

        // Delete existing order items
        $order->orderItems()->delete();

        // Re-create order items
        if (!empty($data['order_items']) && is_array($data['order_items'])) {
            foreach ($data['order_items'] as $item) {
                $orderItem = $order->orderItems()->create($item);

                // Decrease brick residual if order was "new" and changed
                if ($oldStatus === 'new' && $order->order_status !== 'new') {
                    $brick = \App\Models\Brick::find($item['brick_id']);
                    if ($brick) {
                        $brick->residual -= $item['quantity'];
                        $brick->save();
                    }
                }
            }
        }

        // Get user who updated the order
        $updatedBy = Auth::user();
        $updatedByText = "👤 *Updated by:* {$updatedBy->first_name} {$updatedBy->last_name} ({$updatedBy->email})";

        // Send Telegram Notification
        $telegramMessage  = "📢 *Order Status Updated!*\n";
        $telegramMessage .= "🆔 *Order ID:* {$order->id}\n";
        $telegramMessage .= "🔖 *Old Status:* " . ucfirst($oldStatus) . "\n";
        $telegramMessage .= "✅ *New Status:* " . ucfirst($order->order_status) . "\n";
        $telegramMessage .= "📅 *Updated At:* " . now()->format('Y-m-d H:i:s') . "\n";
        $telegramMessage .= "   *Warehouse:* {$brick->residual} \n";
        $telegramMessage .= "{$updatedByText}\n";

        $telegramToken  = env('TELEGRAM_BOT_TOKEN');
        $telegramChatId = env('TELEGRAM_CHAT_ID');

        \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
            'chat_id'    => $telegramChatId,
            'text'       => $telegramMessage,
            'parse_mode' => 'Markdown',
        ]);

        return redirect()->route('driver.orders.index')
            ->with('success', 'Order updated successfully.');
    }
}
