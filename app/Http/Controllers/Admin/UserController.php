<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index(Request $request)
    {
        // Retrieve only customers
        $customers = User::where('role', 'customer')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.users.index', compact('customers'));
    }

    /**
     * Real-time filter function for customers.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $query = User::where('role', 'customer');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(10);

        // Return a partial view for AJAX updates.
        return view('admin.users.partials.user_list', compact('customers'));
    }

    /**
     * Show the form for creating a new customer.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email',
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'city'         => 'nullable|string|max:100',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Optionally include password fields or set a default one.
            'password'     => 'required|string|min:8|confirmed',
        ]);

        // Set role to customer regardless of input.
        $validatedData['role'] = 'customer';

        // Hash the password.
        $validatedData['password'] = bcrypt($validatedData['password']);

        // Handle image upload if provided.
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('user-profiles', 'public');
        }

        User::create($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified customer.
     */
    public function show(User $user)
    {
        // Ensure we only show customers.
        if ($user->role !== 'customer') {
            abort(404);
        }
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified customer.
     */
    public function edit(User $user)
    {
        if ($user->role !== 'customer') {
            abort(404);
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, User $user)
    {
        if ($user->role !== 'customer') {
            abort(404);
        }
        
        $validatedData = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone_number' => 'nullable|string|max:20',
            'address'      => 'nullable|string|max:255',
            'city'         => 'nullable|string|max:100',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password'     => 'nullable|string|min:8|confirmed',
        ]);

        // Handle password update if provided.
        if (!empty($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        // Handle image upload if provided.
        if ($request->hasFile('image')) {
            if ($user->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->image);
            }
            $validatedData['image'] = $request->file('image')->store('user-profiles', 'public');
        }

        $user->update($validatedData);

        return redirect()->route('admin.users.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(User $user)
    {
        if ($user->role !== 'customer') {
            abort(404);
        }
        // Optionally, delete the user's image
        if ($user->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($user->image);
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Customer deleted successfully.');
    }
}
