<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Brick;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.dashboard', compact('sales', 'blogs'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'first_name'           => 'required|string|max:255',
            'last_name'            => 'required|string|max:255',
            'email'                => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number'         => 'nullable|string|max:20',
            'address'              => 'nullable|string|max:255',
            'city'                 => 'nullable|string|max:100',
            'image'                => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_image'         => 'nullable|in:0,1',
            'password'             => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists.
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $validatedData['image'] = $request->file('image')->store('user-profiles', 'public');
        } elseif ($request->remove_image == 1) {
            // Remove image if remove_image flag is set.
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $validatedData['image'] = null;
        }

        // Update password if provided.
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            // Remove password key if not provided so it isn't updated.
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('admin.profile')->with('success', 'Profile updated successfully.');
    }

    public function data(Request $request)
    {
        $filter = $request->input('filter', 'today');

        if ($filter === 'today') {
            $ordersQuery = Order::whereDate('order_date', now()->format('Y-m-d'))
                ->where('order_status', '!=', 'new');
            $previousQuery = Order::whereDate('order_date', now()->subDay()->format('Y-m-d'))
                ->where('order_status', '!=', 'new');
            $period = 'Today';
        } elseif ($filter === 'this_month') {
            $ordersQuery = Order::whereYear('order_date', now()->year)
                ->whereMonth('order_date', now()->month)
                ->where('order_status', '!=', 'new');
            // For comparison, use the previous month in the same year
            $previousQuery = Order::whereYear('order_date', now()->year)
                ->whereMonth('order_date', now()->subMonth()->month)
                ->where('order_status', '!=', 'new');
            $period = 'This Month';
        } elseif ($filter === 'this_year') {
            $ordersQuery = Order::whereYear('order_date', now()->year)
                ->where('order_status', '!=', 'new');
            // For comparison, use the previous year
            $previousQuery = Order::whereYear('order_date', now()->subYear()->year)
                ->where('order_status', '!=', 'new');
            $period = 'This Year';
        } else {
            // Default to today
            $ordersQuery = Order::whereDate('order_date', now()->format('Y-m-d'))
                ->where('order_status', '!=', 'new');
            $previousQuery = Order::whereDate('order_date', now()->subDay()->format('Y-m-d'))
                ->where('order_status', '!=', 'new');
            $period = 'Today';
        }

        // Calculate total sales amount and order count
        $salesAmount = $ordersQuery->sum('total_amount');
        $orderCount  = $ordersQuery->count();

        // Calculate percentage change for sales amount (as an example)
        $previousSales = $previousQuery->sum('total_amount');
        $percentChange = $previousSales > 0
            ? round((($salesAmount - $previousSales) / $previousSales) * 100)
            : 0;
        $trend = $percentChange >= 0 ? 'increase' : 'decrease';

        return response()->json([
            'sales'       => number_format($salesAmount, 2),
            'order_count' => $orderCount,
            'percent'     => abs($percentChange),
            'trend'       => $trend,
            'period'      => $period,
        ]);
    }

    public function customerdata(Request $request)
    {

        $filter = $request->input('filter', 'this_year');

        // Default values
        $period = "This Year";
        $count = User::where('role', 'customer')->whereYear('created_at', now()->year)->count();

        if ($filter === 'today') {
            $count = User::where('role', 'customer')
                ->whereDate('created_at', now()->format('Y-m-d'))
                ->count();
            $period = "Today";
        } elseif ($filter === 'this_month') {
            $count = User::where('role', 'customer')
                ->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count();
            $period = "This Month";
        } elseif ($filter === 'this_year') {
            $count = User::where('role', 'customer')
                ->whereYear('created_at', now()->year)
                ->count();
            $period = "This Year";
        }

        // Optionally, you can calculate percent change and trend using previous period data.
        // For now, we use placeholders:
        $percent = 0;
        $trend = "increase";

        return response()->json([
            'count'   => $count,
            'percent' => $percent,
            'trend'   => $trend,
            'period'  => $period,
        ]);
    }

    public function reportData(Request $request)
    {
        $filter = $request->input('filter', 'today');

        // Initialize arrays for the chart
        $labels = [];
        $salesData = [];
        $revenueData = [];
        $customerData = [];

        if ($filter === 'today') {
            $period = "Today";
            $startOfDay = Carbon::today();
            for ($hour = 0; $hour < 24; $hour++) {
                $rangeStart = $startOfDay->copy()->addHours($hour);
                // Return ISO8601 string as label (valid datetime)
                $labels[] = $rangeStart->toIso8601String();

                $rangeEnd = $rangeStart->copy()->addHour();
                $orders = Order::whereBetween('order_date', [$rangeStart, $rangeEnd])
                    ->where('order_status', '!=', 'new')
                    ->get();
                $salesData[] = $orders->count();
                $revenueData[] = $orders->sum('total_amount');

                $customers = User::where('role', 'customer')
                    ->whereBetween('created_at', [$rangeStart, $rangeEnd])
                    ->count();
                $customerData[] = $customers;
            }
        } elseif ($filter === 'this_month') {
            $period = "This Month";
            $startOfMonth = Carbon::now()->startOfMonth();
            $daysInMonth  = $startOfMonth->daysInMonth;
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $rangeStart = $startOfMonth->copy()->day($day)->startOfDay();
                // Return ISO8601 string as label
                $labels[] = $rangeStart->toIso8601String();

                $rangeEnd   = $rangeStart->copy()->endOfDay();
                $orders = Order::whereBetween('order_date', [$rangeStart, $rangeEnd])
                    ->where('order_status', '!=', 'new')
                    ->get();
                $salesData[]   = $orders->count();
                $revenueData[] = $orders->sum('total_amount');

                $customers = User::where('role', 'customer')
                    ->whereBetween('created_at', [$rangeStart, $rangeEnd])
                    ->count();
                $customerData[] = $customers;
            }
        } elseif ($filter === 'this_year') {
            $period = "This Year";
            for ($month = 1; $month <= 12; $month++) {
                $rangeStart = Carbon::createFromDate(now()->year, $month, 1)->startOfMonth();
                // Return ISO8601 string as label
                $labels[] = $rangeStart->toIso8601String();

                $rangeEnd   = $rangeStart->copy()->endOfMonth();
                $orders = Order::whereBetween('order_date', [$rangeStart, $rangeEnd])
                    ->where('order_status', '!=', 'new')
                    ->get();
                $salesData[]   = $orders->count();
                $revenueData[] = $orders->sum('total_amount');

                $customers = User::where('role', 'customer')
                    ->whereBetween('created_at', [$rangeStart, $rangeEnd])
                    ->count();
                $customerData[] = $customers;
            }
        } else {
            return $this->reportData($request->merge(['filter' => 'today']));
        }

        return response()->json([
            'labels'       => $labels,
            'salesData'    => $salesData,
            'revenueData'  => $revenueData,
            'customerData' => $customerData,
            'period'       => $period,
        ]);
    }

    public function recent(Request $request)
    {
        $filter = $request->input('filter', 'today');

        if ($filter === 'today') {
            $sales = Order::whereDate('order_date', Carbon::today())
                ->where('order_status', '!=', 'new')
                ->latest()->get();
        } elseif ($filter === 'this_month') {
            $sales = Order::whereYear('order_date', Carbon::now()->year)
                ->whereMonth('order_date', Carbon::now()->month)
                ->where('order_status', '!=', 'new')
                ->latest()->get();
        } elseif ($filter === 'this_year') {
            $sales = Order::whereYear('order_date', Carbon::now()->year)
                ->where('order_status', '!=', 'new')
                ->latest()->get();
        } else {
            $sales = Order::whereDate('order_date', Carbon::today())
                ->where('order_status', '!=', 'new')
                ->latest()->get();
        }

        return view('partials.recent-sales', compact('sales'));
    }

    public function topSelling(Request $request)
    {
        $filter = $request->input('filter', 'today');

        if ($filter === 'today') {
            $start = Carbon::today();
            $end   = Carbon::today()->endOfDay();
            $period = 'Today';
        } elseif ($filter === 'this_month') {
            $start = Carbon::now()->startOfMonth();
            $end   = Carbon::now()->endOfMonth();
            $period = 'This Month';
        } elseif ($filter === 'this_year') {
            $start = Carbon::now()->startOfYear();
            $end   = Carbon::now()->endOfYear();
            $period = 'This Year';
        } else {
            // Default to today if unknown filter
            $start = Carbon::today();
            $end   = Carbon::today()->endOfDay();
            $period = 'Today';
        }

        // Aggregate order items joined with orders within the selected period.
        // Exclude orders with status 'new'.
        $topSellingData = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->select('order_items.brick_id', DB::raw('SUM(order_items.quantity) as total_sold'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
            ->whereBetween('orders.order_date', [$start, $end])
            ->where('orders.order_status', '!=', 'new')
            ->groupBy('order_items.brick_id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        $bricks = [];
        foreach ($topSellingData as $data) {
            $brick = Brick::with('images')->find($data->brick_id);
            if ($brick) {
                $brick->total_sold = $data->total_sold;
                $brick->total_revenue = $data->total_revenue;
                $bricks[] = $brick;
            }
        }

        return view('partials.top-selling', compact('bricks', 'period'));
    }

    public function recentNews(Request $request)
    {
        $filter = $request->input('filter', 'today');

        if ($filter === 'today') {
            $blogs = Blog::whereDate('created_at', Carbon::today())
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($filter === 'this_month') {
            $blogs = Blog::whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($filter === 'this_year') {
            $blogs = Blog::whereYear('created_at', Carbon::now()->year)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Default to today
            $blogs = Blog::whereDate('created_at', Carbon::today())
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('partials.news', compact('blogs'));
    }
}
