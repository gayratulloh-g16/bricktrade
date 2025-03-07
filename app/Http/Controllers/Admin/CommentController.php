<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve comments ordered by creation date with pagination.
        $comments = Comment::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Real-time filter function for comments.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $comments = Comment::where(function ($query) use ($search) {
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('comment', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->paginate(10);

        // Return a partial view with the filtered comments.
        return view('admin.comments.partials.comment_list', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blogs = Blog::all();
        return view('admin.comments.create', compact('blogs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        Comment::create($request->validated());

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        $blogs = Blog::all();
        return view('admin.comments.edit', compact('comment', 'blogs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('admin.comments.index')
                         ->with('success', 'Comment deleted successfully.');
    }
}
