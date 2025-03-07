<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactInfoRequest;
use App\Http\Requests\UpdateContactInfoRequest;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    /**
     * Display the contact info form.
     */
    public function index()
    {
        // Get the first (and only) contact info record, if it exists.
        $contactInfo = ContactInfo::first();
        return view('admin.contact-info.index', compact('contactInfo'));
    }

    /**
     * Update (or create) the contact info.
     */
    public function update(UpdateContactInfoRequest $request)
    {
        // Try to get the record.
        $contactInfo = ContactInfo::first();
        if ($contactInfo) {
            // Update existing record.
            $contactInfo->update($request->validated());
        } else {
            // Create new record if none exists.
            ContactInfo::create($request->validated());
        }

        return redirect()->route('admin.contact-info.index')
                         ->with('success', 'Contact information updated successfully.');
    }
}
