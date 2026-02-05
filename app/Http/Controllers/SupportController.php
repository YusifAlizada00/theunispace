<?php

namespace App\Http\Controllers;

use App\Models\SupportRequests;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSupportRequest;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function supportRoute($name)
    {
        return view('support', compact('name'));
    }

    public function submitSupportRequest(CreateSupportRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        // Here you can handle the support request, e.g., save it to the database or send an email
        $help = SupportRequests::create([
            'user_id' => auth()->id(),
            'type' => $data['type'],
            'name' => $data['name'],   
            'email' => $data['email'],
            'page' => $data['page'] ?? null,
            'solution_steps' => $data['solution_steps'] ?? null,
            'feature' => $data['feature'] ?? null,
            'suggestions' => $data['suggestions'] ?? null,
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
        ]);

        Mail::send('emails.support-email-format', ['help' => $help], function($mail) use ($help) {
            $mail->to('yusifalizade2006@gmail.com')->subject("New Help & Support: {$help->type}");
        });

        // For now, just redirect back with a success message
        return redirect()->back()->with('success', 'Your support request has been submitted successfully.');
    }
}
