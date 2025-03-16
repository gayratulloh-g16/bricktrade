<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Brick;
use Illuminate\Support\Facades\Http;


class CheckoutController extends Controller
{


    public function process(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'address'    => 'required|string|max:255',
            'city'       => 'required|string|max:255',
            'email'      => 'required|email|max:255',
            'phone'      => 'nullable|string|max:20',
            'latitude'   => 'required|numeric',
            'longitude'  => 'required|numeric',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->withErrors('Your cart is empty.');
        }

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        $order = Order::create([
            'user_id'          => Auth::id(),
            'driver_id'        => null,
            'order_date'       => now(),
            'total_amount'     => $total,
            'order_status'     => 'new',
            'shipping_address' => $data['address'] . ' ' . ($data['address2'] ?? '') . ', ' . $data['city'],
            'latitude'         => $data['latitude'],
            'longitude'        => $data['longitude'],
        ]);

        foreach ($cart as $productId => $item) {
            $brick = Brick::find($productId);
            if (!$brick) {
                continue;
            }
            OrderItem::create([
                'order_id'   => $order->id,
                'brick_id'   => $brick->id,
                'quantity'   => $item['quantity'],
                'unit_price' => $item['price'],
                'subtotal'   => $item['price'] * $item['quantity'],
            ]);
        }

        session()->forget('cart');

        $telegramMessage  = "📦 *New Order Received!*\n";
        $telegramMessage .= "🆔 *Order ID:* {$order->id}\n";
        $telegramMessage .= "👤 *Customer:* " . Auth::user()->first_name . " " . Auth::user()->last_name . "\n";
        $telegramMessage .= "✉️ *Email:* " . Auth::user()->email . "\n";
        $telegramMessage .= "📞 *Phone:* " . (Auth::user()->phone ?? $data['phone'] ?? 'N/A') . "\n";
        $telegramMessage .= "🔖 *Status:* " . ucfirst($order->order_status) . "\n";
        $telegramMessage .= "💰 *Total:* {$total}\n";
        $telegramMessage .= "🏠 *Shipping Address:* " . $order->shipping_address . "\n\n";
        $telegramMessage .= "🧱 *Order Items:*\n";
        $telegramMessage.= " *Warehouse:* ". $brick->residual;

        foreach ($cart as $productId => $item) {
            $brick = Brick::find($productId);
            if (!$brick) continue;
            $brickName = $brick->{'name_' . app()->getLocale()} ?? $brick->name_en;
            $telegramMessage .= "• {$brickName} - Qty: {$item['quantity']}, Unit: {$item['price']}, Subtotal: " . ($item['price'] * $item['quantity']) . "\n";
        }

        $inlineKeyboard = [
            'inline_keyboard' => [
                [
                    ['text' => 'New', 'callback_data' => "order:{$order->id}:new"],
                    ['text' => 'Process', 'callback_data' => "order:{$order->id}:process"],
                ],
                [
                    ['text' => 'Completed', 'callback_data' => "order:{$order->id}:completed"],
                    ['text' => 'Cancelled', 'callback_data' => "order:{$order->id}:cancelled"],
                ],
            ],
        ];

        $telegramToken  = env('TELEGRAM_BOT_TOKEN');
        $telegramChatId = env('TELEGRAM_CHAT_ID');

        Http::post("https://api.telegram.org/bot{$telegramToken}/sendMessage", [
            'chat_id'     => $telegramChatId,
            'text'        => $telegramMessage,
            'parse_mode'  => 'Markdown',
            'reply_markup' => json_encode($inlineKeyboard),
        ]);

        return redirect()->route('order.confirmation', $order->id)
            ->with('success', 'Your order has been placed successfully!');
    }



    public function confirmation(Order $order)
    {
        return view('frontend.order-confirmation', compact('order'));
    }

    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->orderBy('order_date', 'desc')
            ->paginate(10);
        return view('frontend.order', compact('orders'));
    }

    public function orderDetail(Order $order)
    {
        $order->load('orderItems.brick.images');
        return view('frontend.order-details', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::where('id', $id)->where('order_status', 'new')->firstOrFail();
        $order->update(['order_status' => 'cancelled']);

        return redirect()->route('orders')->with('success', __('main.order_cancelled'));
    }
}
