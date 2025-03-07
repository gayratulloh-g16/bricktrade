<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'text'      => 'required|string|max:255',
        ]);

        Contact::create($validated);

        $botToken = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_CHAT_ID'); 

        $message = "New Contact Submission:\n";
        $message .= "Name: " . $request->name . "\n";
        $message .= "Phone: " . $request->phone_number . "\n";
        $message .= "Text: " . $request->text;

        \Illuminate\Support\Facades\Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
            'chat_id' => $chatId,
            'text'    => $message,
        ]);

        return response()->json(['message' => 'Your request has been sent successfully!']);
    }
}
