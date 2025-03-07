<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use App\Http\Requests\UpdateFeedbackRequest;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Load feedbacks with their related user and order data.
        $feedbacks = Feedback::with(['user', 'order'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.feedback.index', compact('feedbacks'));
    }

    /**
     * Real-time filter function for feedbacks.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $feedbacks = Feedback::with(['user', 'order'])
            ->where(function ($query) use ($search) {
                $query->where('rating', 'like', "%{$search}%")
                      ->orWhere('text', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.feedback.partials.feedback_list', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $orders = Order::all();
        return view('admin.feedback.create', compact('users', 'orders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        Feedback::create($data);

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        return view('admin.feedback.show', compact('feedback'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        $users = User::all();
        $orders = Order::all();
        return view('admin.feedback.edit', compact('feedback', 'users', 'orders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $data = $request->validated();
        $feedback->update($data);

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        $feedback->delete();

        return redirect()->route('admin.feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}
