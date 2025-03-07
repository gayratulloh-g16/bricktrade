<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brick;
use App\Models\Review;
use App\Models\OrderItem;

class ReviewController extends Controller
{
    public function storeReview(Request $request, Brick $brick)
    {
        $user = auth()->user();
    
        // Validate input including rating
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'text'   => 'required|string',
        ]);
    
        // Ensure the user has purchased the product
        $hasPurchased = \App\Models\OrderItem::where('brick_id', $brick->id)
            ->whereHas('order', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->exists();
    
        if (!$hasPurchased) {
            return response()->json(['message' => __('main.purchase_required_review')], 403);
        }
    

        
        $review = Review::create([
            'user_id'  => $user->id,
            'brick_id' => $brick->id,
            'rating'   => $validated['rating'],
            'text'     => $validated['text'],
        ]);
    
        // Render the new review partial
        $reviewHtml = view('partials.review', compact('review'))->render();
    
        return response()->json([
            'message' => 'Review submitted successfully!',
            'review_html' => $reviewHtml
        ]);
    }
    
    
}
