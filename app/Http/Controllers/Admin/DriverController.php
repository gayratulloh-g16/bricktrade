<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\User;
use App\Models\Driver;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // For admin, list all drivers
        $drivers = Driver::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new driver (registration for driver role).
     */
    public function create()
    {
        return view('admin.drivers.create');
    }

    /**
     * Store a newly created driver (and corresponding user) in storage.
     */
    public function store(StoreDriverRequest $request)
    {
        $data = $request->validated();

        // Create the user with role 'driver'
        $user = User::create([
            'first_name'    => $data['first_name'],
            'last_name'     => $data['last_name'],
            'email'         => $data['email'],
            'password'      => Hash::make($data['password']),
            'phone_number'  => $data['phone_number'], // optional: if needed in user table
            'address'       => $data['address'] ?? null,
            'city'          => $data['city'] ?? null,
            'role'          => 'driver',
            // 'image' field can be handled separately if desired.
        ]);

        // Create the driver record linked to this user
        Driver::create([
            'user_id'         => $user->id,
            'phone_number'    => $data['phone_number'],
            'vehicle_number'  => $data['vehicle_number'],
            'latitude'        => $data['latitude'] ?? null,
            'longitude'       => $data['longitude'] ?? null,
        ]);



        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver registered successfully.');
    }

    /**
     * Display the specified driver.
     */
    public function show(Driver $driver)
    {
        return view('admin.drivers.show', compact('driver'));
    }

    /**
     * Show the form for editing the specified driver.
     */
    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    /**
     * Update the specified driver record.
     */
    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $data = $request->validated();

        // Prepare user update data.
        $userData = [
            'first_name'   => $data['first_name'],
            'last_name'    => $data['last_name'],
            'email'        => $data['email'],
            'phone_number' => $data['phone_number'],
            'address'      => $data['address'] ?? null,
            'city'         => $data['city'] ?? null,
        ];

        // Update password only if provided.
        if (!empty($data['password'])) {
            $userData['password'] = Hash::make($data['password']);
        }

        // Update the associated user record.
        $driver->user()->update($userData);

        // Prepare driver update data.
        $driverData = [
            'phone_number'   => $data['phone_number'],  // You may store a copy here too.
            'vehicle_number' => $data['vehicle_number'],
            'latitude'       => $data['latitude'] ?? null,
            'longitude'      => $data['longitude'] ?? null,
        ];

        // Update the driver record.
        $driver->update($driverData);

        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver updated successfully.');
    }

    /**
     * Remove the specified driver from storage.
     */
    public function destroy(Driver $driver)
    {
        $driver->delete();

        return redirect()->route('admin.drivers.index')
            ->with('success', 'Driver deleted successfully.');
    }
}
