<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Mail\NewFollowingPostEmail;
use App\Models\LikedPost;
use App\Models\ReportContent;
use App\Notifications\FollowingPostedNotification;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;
use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use FFMpeg\Coordinate\Dimension;



class PostController extends Controller
{
    public function getAllPosts()
    {
        $hiddenPostIds = ReportContent::where('is_hidden', true)->pluck('reported_post_id');
        $query = Post::latest()->whereNotIn('id', $hiddenPostIds);

        if (auth()->check()) {
            $posts = $query->get();
        } else {
            $posts = $query->take(10)->get();
        }
        $user = auth()->user();
        return view('dashboard', compact('posts', 'user'));
    }
    public function getFollowingsPosts()
    {
        //pluck - it gets the column in specified table
        $followingIds = auth()->user()->following()->pluck('users.id'); // <- specify table
        $query = Post::whereIn('user_id', $followingIds);
        if (auth()->check()) {
            $posts = $query->get();
        } else {
            $posts = $query->take(10)->get();
        }
        return view('dashboard', compact('posts'));
    }

    public function singlePost($slug)
    {
        $singlePost = Post::where('slug', $slug)->firstOrFail();
        $user = auth()->user();
        return view('single-post', compact('singlePost', 'user'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        // Create the post first
        $post = Post::create($data);

        // Handle media files
        if ($request->hasFile('media')) {
            $manager = new ImageManager(new Driver());
            $width = 500;

            foreach ($request->file('media') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = 'posts/' . $filename;

                if (str_contains($file->getMimeType(), 'image')) {
                    // Process image using read()
                    $img = $manager->read($file);
                    $img->scaleDown(width: 1200);
                    $img->encode(new \Intervention\Image\Encoders\JpegEncoder(quality: 95));
                    $img->save(storage_path('app/public/' . $path));
                    $type = 'image';
                } elseif (str_contains($file->getMimeType(), 'video')) {

                    // 1. SAVE RAW TEMP FILE (Explicitly to 'local' disk)
                    // We force 'local' so we know EXACTLY where it is (storage/app/temp_videos)
                    $tempRelativePath = $file->store('temp_videos', 'local');

                    // 2. GET ABSOLUTE WINDOWS PATH
                    // This asks Laravel for the real C:\Path\To\File. 
                    // It automatically handles backslashes and drive letters correctly.
                    $inputPath = Storage::disk('local')->path($tempRelativePath);

                    // 3. DEFINE OUTPUT
                    $finalFilename = 'posts/' . Str::random(40) . '.mp4';
                    $outputPath = storage_path('app/public/' . $finalFilename);

                    // Ensure output directory exists
                    if (!file_exists(dirname($outputPath))) {
                        mkdir(dirname($outputPath), 0755, true);
                    }

                    $defaultFfmpeg = str_starts_with(strtoupper(PHP_OS), 'WIN') ? 'C:/ffmpeg/bin/ffmpeg.exe' : '/usr/bin/ffmpeg';
                    $defaultFfprobe = str_starts_with(strtoupper(PHP_OS), 'WIN') ? 'C:/ffmpeg/bin/ffprobe.exe' : '/usr/bin/ffprobe';

                    // 2. INITIALIZE FFMPEG
                    // We try to use the .env value first. If that's missing, we use the OS default we just calculated.
                    $ffmpeg = FFMpeg::create([
                        'ffmpeg.binaries' => env('FFMPEG_BINARIES', $defaultFfmpeg),
                        'ffprobe.binaries' => env('FFPROBE_BINARIES', $defaultFfprobe),
                        'timeout' => 3600,
                        'ffmpeg.threads' => 12,
                    ]);

                    // 5. PROCESS VIDEO
                    $video = $ffmpeg->open($inputPath);

                    // Resize to 720p
                    $video->filters()->resize(new Dimension(1280, 720))->synchronize();

                    // Fix Sound (Force AAC)
                    $format = new X264();
                    $format->setAudioCodec('aac');

                    // Save
                    $video->save($format, $outputPath);

                    // 6. CLEANUP
                    // Delete the temp file from the 'local' disk
                    Storage::disk('local')->delete($tempRelativePath);

                    // Set DB Variables
                    $path = $finalFilename;
                    $type = 'video';

                } else {
                    continue;
                }

                // Save media to post_media table
                $post->media()->create([
                    'path' => $path,
                    'type' => $type,
                ]);
            }
        }

        // Notify followers
        $user = Auth::user();
        $url = route('single-post', $post->slug);

        $recipients = $user->is_admin ? User::all() : $user->followers;
        $recipients = $recipients->unique('id')->where('id', '!=', $user->id);

        foreach ($recipients as $recipient) {
            $recipient->notify(new FollowingPostedNotification($user, $post));
            Mail::to($recipient->email)->send(new NewFollowingPostEmail($user, $post, $url));
        }

        return redirect()->route('dashboard.all.posts')->with('success', 'Post was created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $name, Post $post)
    {
        // Get the user by slug
        $user = User::where('slug', $name)->firstOrFail();
        // Get all their posts (optional: latest first)
        $posts = $user->posts()->latest()->get();
        return view('profile.show', compact('user', 'posts'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Optional: Restrict edit to the owner
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('edit-post', compact('post'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // 1. Validate and update basic post data (description, etc.)
        $data = $request->validated();
        $post->update($data);

        // 2. Handle media files
        if ($request->hasFile('media')) {

            // OPTIONAL: Delete old media if you want to REPLACE them with the new upload
            foreach ($post->media as $oldMedia) {
                $oldPath = storage_path('app/public/' . $oldMedia->path);
                if (file_exists($oldPath)) {
                    unlink($oldPath); // Remove physical file
                }
                $oldMedia->delete(); // Remove database record
            }

            $manager = new ImageManager(new Driver());
            $width = 500;

            foreach ($request->file('media') as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . uniqid() . '.' . $extension;
                $path = 'posts/' . $filename;

                if (str_contains($file->getMimeType(), 'image')) {
                    // Process image
                    $img = $manager->read($file);
                    $img->scaleDown(width: 1200);
                    $img->encode(new \Intervention\Image\Encoders\JpegEncoder(quality: 95));
                    $img->save(storage_path('app/public/' . $path));
                    $type = 'image';
                } elseif (str_contains($file->getMimeType(), 'video')) {
                    
                    // 1. SAVE RAW TEMP FILE (Explicitly to 'local' disk)
                    $tempRelativePath = $file->store('temp_videos', 'local'); 

                    // 2. GET ABSOLUTE PATH (Windows/Linux Safe)
                    $inputPath = Storage::disk('local')->path($tempRelativePath);

                    // 3. DEFINE OUTPUT
                    $finalFilename = 'posts/' . Str::random(40) . '.mp4';
                    $outputPath = storage_path('app/public/' . $finalFilename);

                    // Ensure output directory exists
                    if (!file_exists(dirname($outputPath))) {
                        mkdir(dirname($outputPath), 0755, true);
                    }

                    // 4. DETECT OS & INITIALIZE FFMPEG
                    $isWindows = str_starts_with(strtoupper(PHP_OS), 'WIN');
                    $defaultFfmpeg  = $isWindows ? 'C:/ffmpeg/bin/ffmpeg.exe' : '/usr/bin/ffmpeg';
                    $defaultFfprobe = $isWindows ? 'C:/ffmpeg/bin/ffprobe.exe' : '/usr/bin/ffprobe';

                    $ffmpeg = FFMpeg::create([
                        'ffmpeg.binaries'  => env('FFMPEG_BINARIES', $defaultFfmpeg),
                        'ffprobe.binaries' => env('FFPROBE_BINARIES', $defaultFfprobe),
                        'timeout'          => 3600,
                        'ffmpeg.threads'   => 12,
                    ]);

                    // 5. PROCESS VIDEO
                    $video = $ffmpeg->open($inputPath);

                    // Resize to 720p
                    $video->filters()->resize(new Dimension(1280, 720))->synchronize();
                    
                    $format = new X264();
                    $format->setAudioCodec('aac'); 
                    $format->setAudioKiloBitrate(128); 

                    // Save
                    $video->save($format, $outputPath);

                    // 6. CLEANUP
                    Storage::disk('local')->delete($tempRelativePath);

                    $path = $finalFilename;
                    $type = 'video';

                } else {
                    continue; // Skip unsupported files
                }

                // Save new media
                $post->media()->create([
                    'path' => $path,
                    'type' => $type,
                ]);
            }
        }

        return redirect()->route('dashboard.all.posts')->with('success', 'Post updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (auth()->id() !== $post->user_id) {
            abort(403);
        }
        $post->delete();

        return redirect()->route('dashboard.all.posts')->with('delete', 'Goal has been deleted!');
    }
    public function allPosts($name)
    {
        $user = User::where('slug', $name)->firstOrFail();
        $posts = Post::where('user_id', $user->id)->latest()->get();

        return view('profile.show', compact('user', 'posts'));
    }
    public function savedPosts($name)
    {
        $user = User::where('slug', $name)->firstOrFail();
        $posts = $user->savedPost()->get();

        return view('profile.show', compact('user', 'posts'));
    }
    public function moveToLikedPosts($name)
    {
        $user = User::where('slug', $name)->firstOrFail();
        $posts = Auth::user()->likedPost()->get();
        return view('profile.show', compact('user', 'posts'));
    }

    public function topLikedPosts(Post $post)
    {
        $hiddenPostIds = ReportContent::where('is_hidden', true)->pluck('reported_post_id');

        $posts = Post::withCount('likedUsers')
            ->whereNotIn('id', $hiddenPostIds)
            ->orderBy('liked_users_count', 'desc')
            ->get();

        return view('dashboard', compact('posts'));
    }
}