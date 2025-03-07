<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(Request $request)
    {
        // Retrieve contacts ordered by creation date with pagination
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }


    public function filter(Request $request)
    {
        $search = $request->input('search', '');

        $query = Contact::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('phone_number', 'like', "%{$search}%")
                    ->orWhere('text', 'like', "%{$search}%");
            });
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(10);

        // Return only the partial view for the filtered list
        return view('admin.contacts.partials.contact_list', compact('contacts'));
    }


    public function create()
    {
        return view('admin.contacts.create');
    }


    public function store(StoreContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact created successfully.');
    }


    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }


    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }


    public function update(UpdateContactRequest $request, Contact $contact)
    {
        $contact->update($request->validated());
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact updated successfully.');
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }
}
