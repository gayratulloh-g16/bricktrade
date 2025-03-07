<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $drivers = Driver::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Real-time filter function for drivers.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $drivers = Driver::where(function ($query) use ($search) {
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('vehicle_number', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10);

        // Return the partial view for dynamic updates.
        return view('admin.drivers.partials.driver_list', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        Driver::create($request->validated());

        return redirect()->route('admin.drivers.index')
                         ->with('success', 'Driver created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        return view('admin.drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $driver->update($request->validated());

        return redirect()->route('admin.drivers.index')
                         ->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('admin.drivers.index')
                         ->with('success', 'Driver deleted successfully.');
    }
}
