<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportLostRequest;
use Illuminate\Http\Request;
use App\Models\ReportLost;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;
use App\Mail\ContactLostReportMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ContactLostReportRequest;
use App\Models\ContactLostReport;
use App\Http\Requests\UpdateReportLostRequest;

class ReportLostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ReportLost $reportLost)
    {
        $reported_items = ReportLost::latest()->get();
        return view('lost-found', compact('reported_items', 'reportLost'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showContactForm(ReportLost $reportLost)
    {
        return view('contact-form', compact('reportLost'));
    }

    public function sendInfo(ReportLost $reportLost)
    {
        return view('contact-form', compact('reportLost'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ReportLostRequest $request)
    {
        // 1. Validate inputs
        $data = $request->validated();

        // 2. Handle Images
        if ($request->hasFile('images_lost')) {
            $paths = [];
            $manager = new ImageManager(new Driver());

            // Ensure directory exists
            $directory = storage_path('app/public/lost_items');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            foreach ($request->file('images_lost') as $image) {
                // FIX: Add uniqid() to ensure every filename is different, even in the same second
                $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $directory . '/' . $filename;

                // Process Image
                $img = $manager->read($image);
                $img->scale(600);
                $img->encode(new JpegEncoder(95));
                $img->save($path);

                // Store relative path for database
                $paths[] = "lost_items/{$filename}";
            }

            $data['images_lost'] = $paths;
        }

        // 3. Add User ID
        $data['user_id'] = auth()->id();

        // 4. Create Record
        ReportLost::create($data);

        // 5. Redirect (Clean)
        // Don't pass 'reported_items'. The 'lost-found' route will load them fresh.
        return redirect()->route('lost-found')->with('success', 'Report created successfully!');
    }

    public function contact(ContactLostReportRequest $request, ReportLost $reportLost)
    {
        $data = $request->validated();

        // ... (Your existing Image Logic is correct here) ... 
        if ($request->hasFile('images_found')) {
            $paths = [];
            $manager = new ImageManager(new Driver());
            
            $directory = storage_path('app/public/found_items');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            foreach ($request->file('images_found') as $image) {
                $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $directory . '/' . $filename;

                $img = $manager->read($image);
                $img->scale(600);
                $img->encode(new JpegEncoder(95));
                $img->save($path);

                $paths[] = "found_items/{$filename}";
            }
            $data['images_found'] = $paths;
        }

        $data['user_id'] = auth()->id();
        $data['reported_lost_id'] = $reportLost->id;

        $contact = ContactLostReport::create($data);

        // --- SAFETY CHECK START ---
        try {
            $report_owner = $contact->reportLost->user;
            Mail::to($report_owner->email)->send(new ContactLostReportMail($contact));
        } catch (\Exception $e) {
            // If email fails, Log it but DO NOT crash the page
            \Log::error('Contact Email Failed: ' . $e->getMessage());
            
            // Return with a warning so you know it failed
            return redirect()->route('lost-found')->with('warning', 'Report submitted, but we could not send the email notification.');
        }
        // --- SAFETY CHECK END ---

        return redirect()->route('lost-found')->with('success', 'Message was sent successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(ReportLost $reportLost)
    {
        return view('lost-report-show', compact('reportLost'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportLost $reportLost)
    {
        $reportLost = ReportLost::where('slug', $reportLost->slug)->firstOrFail();
        return view('edit-lost-report', compact('reportLost'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportLost $reportLost)
    {

        if (auth()->id() !== $reportLost->user_id) {
            abort(403);
        }
        $reportLost->delete();

        return redirect()->route('lost-found')->with('delete', true);
    }

    /**
     * Mark the specified report as found (sets `found` to true).
     */
    public function markFound(ReportLost $reportLost)
    {
        if (auth()->id() !== $reportLost->user_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Toggle the found state
        $reportLost->found = !(bool) $reportLost->found;
        $reportLost->save();

        $message = $reportLost->found ? 'Marked as found' : 'Marked as lost';

        return response()->json(['message' => $message, 'found' => (bool) $reportLost->found]);
    }

    public function userLostItems($name)
    {
        $user = \App\Models\User::where('slug', $name)->firstOrFail();
        $lostItems = ReportLost::where('user_id', $user->id)->latest()->get();

        return view('profile.show', compact('user', 'lostItems'));
    }
}
