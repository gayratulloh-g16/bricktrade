<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Brick;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve orders with related user, driver, and order items (and their associated bricks)
        $orders = Order::with(['user', 'driver', 'orderItems.brick'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Real-time filter function for orders.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        // Build a query searching order status, shipping address, or order_date.
        $query = Order::with(['user', 'driver', 'orderItems.brick']);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('order_status', 'like', "%{$search}%")
                    ->orWhere('shipping_address', 'like', "%{$search}%")
                    ->orWhereDate('order_date', $search);
            });
        }

        $orders = $query->orderBy('order_date', 'desc')->paginate(10);

        // Return a partial view (e.g., admin/orders/partials/order_list.blade.php) for AJAX updates
        return view('admin.orders.partials.order_list', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // You might need to pass available users, drivers, and bricks for selection.
        $users   = \App\Models\User::all();
        $drivers = \App\Models\Driver::all();
        $bricks  = \App\Models\Brick::all();

        return view('admin.orders.create', compact('users', 'drivers', 'bricks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        // Create the order record
        $order = Order::create([
            'user_id'         => $data['user_id'],
            'driver_id'       => $data['driver_id'],
            'order_date'      => $data['order_date'],
            'total_amount'    => $data['total_amount'],
            'order_status'    => $data['order_status'],
            'shipping_address' => $data['shipping_address'],
        ]);

        // Create order items if provided
        if (!empty($data['order_items']) && is_array($data['order_items'])) {
            foreach ($data['order_items'] as $item) {
                // Each $item should have 'brick_id', 'quantity', 'unit_price'
                $order->orderItems()->create($item);
            }
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Load relationships for detailed view
        $order->load(['user', 'driver', 'orderItems.brick', 'feedback']);
        return view('admin.orders.show', compact('order'));
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
        return view('admin.orders.edit', compact('order', 'users', 'drivers', 'bricks'));
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
            'user_id'         => $data['user_id'],
            'driver_id'       => $data['driver_id'],
            'order_date'      => $data['order_date'],
            'total_amount'    => $data['total_amount'],
            'order_status'    => $data['order_status'],
            'shipping_address' => $data['shipping_address'],
        ]);

        // Delete existing order items
        $order->orderItems()->delete();

        // Re-create order items
        if (!empty($data['order_items']) && is_array($data['order_items'])) {
            foreach ($data['order_items'] as $item) {
                $orderItem = $order->orderItems()->create($item);

                // If the order's old status was "new" and it is now changed to something else,
                // then decrease the brick's residual quantity.
                if ($oldStatus === 'new' && $order->order_status !== 'new') {
                    $brick = \App\Models\Brick::find($item['brick_id']);
                    if ($brick) {
                        // Decrease the residual by the order item quantity
                        $brick->residual = $brick->residual - $item['quantity'];
                        $brick->save();
                    }
                }
            }
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Delete associated order items
        $order->orderItems()->delete();
        // Optionally, delete feedback if needed:
        if ($order->feedback) {
            $order->feedback->delete();
        }
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully.');
    }
}
