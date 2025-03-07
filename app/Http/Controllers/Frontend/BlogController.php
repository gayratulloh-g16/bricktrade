<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function storeComment(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email',
            'comment'    => 'required|string',
            'blog_id'    => 'required|exists:blogs,id',
        ]);

        $comment = Comment::create($validated);

        $commentHtml = view('partials.comment', compact('comment'))->render();

        return response()->json(['comment_html' => $commentHtml]);
    }
}
