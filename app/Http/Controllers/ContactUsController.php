<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactUsRequest;
use App\Mail\ContactUs;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contactUs(ContactUsRequest $request)
    {
        $validated = $request->validated();

        Mail::to(config('mail.mailers.smtp.username'))->send(
            new ContactUs(
                name: $validated['name'],
                email: $validated['email'],
                messageText: $validated['message']
            )
        );

        return response()->json(['success' => true]);
    }
}
