<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $blogs = Blog::where(function($query) use ($search) {
            $query->where('title_uz', 'like', "%{$search}%")
                  ->orWhere('title_ru', 'like', "%{$search}%")
                  ->orWhere('title_en', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(20);

        // Return the partial view with the filtered blogs.
        return view('admin.blogs.partials.blog_list', compact('blogs'));
    }

    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(20);

        return view('admin.blogs.index', compact('blogs'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }


    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }


    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }


    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();

        if ($request->hasFile('image')){
            $data['image'] = $request->file('image')->store('blogs', 'public');
            $currentImage = $blog->image;
            if ($currentImage) {
                Storage::delete('public/'. $currentImage);
            }
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }


    public function destroy(Blog $blog)
    {
        Storage::delete('public/'. $blog->image);

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
