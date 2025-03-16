<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Order;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'user_id'  => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'rating'   => 'required|numeric|min:1|max:5',
            'text'     => 'required|string',
        ]);

        // Retrieve the order using the order_id from the form
        $order = Order::find($data['order_id']);
        if (!$order) {
            return redirect()->back()->withErrors(['order_id' => 'Invalid order.']);
        }

        // Check that the order is completed and no feedback exists yet
        if ($order->order_status !== 'completed') {
            return redirect()->back()->withErrors(['order' => 'Feedback can only be submitted for completed orders.']);
        }
        if ($order->feedback) {
            return redirect()->back()->withErrors(['order' => 'Feedback for this order has already been submitted.']);
        }

        // Create the feedback record
        Feedback::create($data);

        return redirect()->route('order.detail', ['order' => $order->id])
            ->with('success', 'Feedback submitted successfully.');
    }
}
