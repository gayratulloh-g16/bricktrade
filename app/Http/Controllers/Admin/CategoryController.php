<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        // Optionally filter by search query.
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name_uz', 'like', "%{$search}%")
                  ->orWhere('name_ru', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%");
            });
        }

        $categories = $query->orderBy('created_at', 'desc')->paginate(10);

        // For non-AJAX requests, return the full index view.
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Real-time filter function for categories.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $categories = Category::where(function($q) use ($search) {
                $q->where('name_uz', 'like', "%{$search}%")
                  ->orWhere('name_ru', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return only the partial view for the filtered list.
        return view('admin.categories.partials.category_list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
