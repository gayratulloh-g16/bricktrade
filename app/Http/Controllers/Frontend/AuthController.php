<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->isCustomer()) {
                return redirect()->route('home');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Unauthorized access.']);
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function showRegistrationForm()
    {
        return view('frontend.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'required|string|max:19',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'city' => $data['city'],
            'image' => $request->image? $request->image->store('uploads/users', 'public') : null,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',
        ]);

        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('frontend.login');
    }

     // Show the user's profile for editing
     public function profile()
     {
         $user = Auth::user();
         return view('frontend.profile', compact('user'));
     }
 
     // Update the user's profile
     public function updateProfile(Request $request)
     {
         $user = Auth::user();
 
         // Validate input
         $data = $request->validate([
             'first_name'   => 'required|string|max:255',
             'last_name'    => 'required|string|max:255',
             'email'        => 'required|email|max:255|unique:users,email,' . $user->id,
             'phone_number' => 'nullable|string|max:20',
             'address'      => 'nullable|string|max:255',
             'city'         => 'nullable|string|max:255',
             'image'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'remove_image' => 'nullable|in:0,1',
         ]);
 
         // Handle image upload or removal
         if ($request->hasFile('image')) {
             // Remove old image if exists
             if ($user->image && Storage::disk('public')->exists($user->image)) {
                 Storage::disk('public')->delete($user->image);
             }
             $data['image'] = $request->file('image')->store('uploads/users', 'public');
         } elseif ($request->remove_image == 1) {
             if ($user->image && Storage::disk('public')->exists($user->image)) {
                 Storage::disk('public')->delete($user->image);
             }
             $data['image'] = null;
         }
 
         // Optionally, update the password if a new one is provided
         if ($request->filled('password')) {
             $request->validate([
                 'password' => 'sometimes|string|min:6|confirmed',
             ]);
             $data['password'] = Hash::make($request->password);
         }
 
         // Update the user
         $user->update($data);
 
         return redirect()->route('frontend.profile')
             ->with('success', 'Profile updated successfully.');
     }
}
