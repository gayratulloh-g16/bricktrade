<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Retrieve today's recent sales (you can adjust the filter as needed)
        $sales = Order::whereDate('order_date', Carbon::today())
            ->where('order_status', '!=', 'new')
            ->latest()
            ->get();

        $blogs = Blog::whereDate('created_at', \Carbon\Carbon::today())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('driver.dashboard', compact('sales', 'blogs'));
    }
}
