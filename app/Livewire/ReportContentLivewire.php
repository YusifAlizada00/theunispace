<?php

namespace App\Livewire;

use App\Mail\NewReportEmail;
use App\Mail\UrgentReportEmail;
use Livewire\Component;
use App\Models\ReportContent;
use Illuminate\Support\Facades\Mail;
use App\Models\Post;

class ReportContentLivewire extends Component
{
    public $postId;
    public $reasons = [];
    public $additional_info;

    public $finish;

    // optional mount to ensure postId is set when component created
    public function mount($postId = null)
    {
        $this->postId = $postId;
    }

public function submit()
{
    $this->validate([
        'reasons' => 'required|array|min:1',
        'reasons.*' => 'string',
        'additional_info' => 'nullable|string|max:1000',
    ]);

    $post = Post::with('user')->findOrFail($this->postId);
    $reporter = auth()->user();

    ReportContent::create([
        'reporter_id'      => $reporter->id,
        'reported_post_id' => $post->id,
        'reasons'          => json_encode($this->reasons),
        'additional_info'  => $this->additional_info,
    ]);

    $this->js("
        Toastify({
            text: 'Report submitted successfully!',
            duration: 2000,
            gravity: 'top',
            position: 'center',
            backgroundColor: '#4ade80',
        }).showToast();
    ");
    $url = route('single-post',  ['slug' => $post->slug]);
    Mail::to('yusifalizade2006@gmail.com')->send(new NewReportEmail($reporter, $post, $this->reasons, $this->additional_info, $url));

    // Check if the post has been reported more than 2 times
    $reportCount = ReportContent::where('reported_post_id', $post->id)->count();
    if ($reportCount >= 1) {
        ReportContent::where('reported_post_id', $post->id)->update(['is_hidden' => true]);
        Mail::to('yusifalizade2006@gmail.com')->send(new UrgentReportEmail($reporter, $post, $this->reasons, $this->additional_info, $url));
    }

    $this->reset(['reasons', 'additional_info']);
}


    public function render()
    {
        return view('livewire.report-content-livewire');
    }
}
