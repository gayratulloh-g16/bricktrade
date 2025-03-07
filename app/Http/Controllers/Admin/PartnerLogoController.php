<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePartnerLogoRequest;
use App\Http\Requests\UpdatePartnerLogoRequest;
use App\Models\PartnerLogo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerLogoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $partnerLogos = PartnerLogo::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.partner-logos.index', compact('partnerLogos'));
    }

    /**
     * Real-time filter function for partner logos.
     */
    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $partnerLogos = PartnerLogo::where('name', 'like', "%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Return a partial view for dynamic updates (e.g., via AJAX)
        return view('admin.partner-logos.partials.partner_logo_list', compact('partnerLogos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partner-logos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerLogoRequest $request)
    {
        $data = $request->validated();

        // Handle image upload if exists.
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('partner-logos', 'public');
        }

        PartnerLogo::create($data);

        return redirect()->route('admin.partner-logos.index')
                         ->with('success', 'Partner logo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PartnerLogo $partnerLogo)
    {
        return view('admin.partner-logos.show', compact('partnerLogo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PartnerLogo $partnerLogo)
    {
        return view('admin.partner-logos.edit', compact('partnerLogo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerLogoRequest $request, PartnerLogo $partnerLogo)
    {
        $data = $request->validated();

        // Handle image update if new file is uploaded.
        if ($request->hasFile('image')) {
            // Optionally, delete the old image if it exists.
            if ($partnerLogo->image && Storage::disk('public')->exists($partnerLogo->image)) {
                Storage::disk('public')->delete($partnerLogo->image);
            }
            $data['image'] = $request->file('image')->store('partner-logos', 'public');
        }

        $partnerLogo->update($data);

        return redirect()->route('admin.partner-logos.index')
                         ->with('success', 'Partner logo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PartnerLogo $partnerLogo)
    {
        // Optionally delete the image file.
        if ($partnerLogo->image && Storage::disk('public')->exists($partnerLogo->image)) {
            Storage::disk('public')->delete($partnerLogo->image);
        }

        $partnerLogo->delete();

        return redirect()->route('admin.partner-logos.index')
                         ->with('success', 'Partner logo deleted successfully.');
    }
}
