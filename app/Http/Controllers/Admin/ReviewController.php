<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Load reviews with related user and brick data.
        $reviews = Review::with(['user', 'brick'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Real-time filter function for reviews.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');
        
        $reviews = Review::with(['user', 'brick'])
            ->where(function ($query) use ($search) {
                $query->where('rating', 'like', "%{$search}%")
                      ->orWhere('text', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.reviews.partials.review_list', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve collections for select dropdowns.
        $users  = \App\Models\User::all();
        $bricks = \App\Models\Brick::all();
        return view('admin.reviews.create', compact('users', 'bricks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $data = $request->validated();
        Review::create($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $review->load(['user', 'brick']);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        $users  = \App\Models\User::all();
        $bricks = \App\Models\Brick::all();
        return view('admin.reviews.edit', compact('review', 'users', 'bricks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $data = $request->validated();
        $review->update($data);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
