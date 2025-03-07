<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrickRequest;
use App\Http\Requests\UpdateBrickRequest;
use App\Models\Brick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrickController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Retrieve bricks ordered by creation date with pagination.
        $bricks = Brick::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.bricks.index', compact('bricks'));
    }

    /**
     * Real-time filter function for bricks.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $bricks = Brick::where(function($query) use ($search) {
            $query->where('name_uz', 'like', "%{$search}%")
                  ->orWhere('name_ru', 'like', "%{$search}%")
                  ->orWhere('name_en', 'like', "%{$search}%");
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        // Return a partial view for AJAX updates.
        return view('admin.bricks.partials.brick_list', compact('bricks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bricks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrickRequest $request)
    {
        $data = $request->validated();

        // Create the brick record.
        $brick = Brick::create([
            'name_uz'         => $data['name_uz'],
            'name_ru'         => $data['name_ru'],
            'name_en'         => $data['name_en'],
            'price'           => $data['price'],
            'description_uz'  => $data['description_uz'],
            'description_ru'  => $data['description_ru'],
            'description_en'  => $data['description_en'],
            'residual'        => $data['residual'],
        ]);

        // If multiple images were uploaded, store each one.
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('brick-images', 'public');
                // Save the image record via the relationship.
                $brick->images()->create(['image' => $path]);
            }
        }

        return redirect()->route('admin.bricks.index')
            ->with('success', 'Brick created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brick $brick)
    {
        return view('admin.bricks.show', compact('brick'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brick $brick)
    {
        return view('admin.bricks.edit', compact('brick'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrickRequest $request, Brick $brick)
    {
        $data = $request->validated();

        // Update the brick record.
        $brick->update([
            'name_uz'         => $data['name_uz'],
            'name_ru'         => $data['name_ru'],
            'name_en'         => $data['name_en'],
            'price'           => $data['price'],
            'description_uz'  => $data['description_uz'],
            'description_ru'  => $data['description_ru'],
            'description_en'  => $data['description_en'],
            'residual'        => $data['residual'],
        ]);

            // Remove images marked for deletion.
    if ($request->has('remove_images')) {
        foreach ($request->remove_images as $removeImageId) {
            $brickImage = $brick->images()->find($removeImageId);
            if ($brickImage) {
                if (Storage::disk('public')->exists($brickImage->image)) {
                    Storage::disk('public')->delete($brickImage->image);
                }
                $brickImage->delete();
            }
        }
    }

    // If new images are provided, store them.
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('brick-images', 'public');
            $brick->images()->create(['image' => $path]);
        }
    }

        return redirect()->route('admin.bricks.index')
            ->with('success', 'Brick updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brick $brick)
    {
        // Delete associated images from storage.
        foreach ($brick->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
            $image->delete();
        }
        $brick->delete();

        return redirect()->route('admin.bricks.index')
            ->with('success', 'Brick deleted successfully.');
    }
}
