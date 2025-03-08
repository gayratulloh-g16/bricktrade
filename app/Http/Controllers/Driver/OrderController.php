<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Order;
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
        // Optionally, ensure that the order belongs to the authenticated driver.
        $user = Auth::user();
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
}
