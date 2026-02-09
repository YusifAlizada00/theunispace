<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StudyGroupController;
use App\Http\Controllers\UserController;
use App\Livewire\FollowerList;
use App\Livewire\FollowingList;
use App\Livewire\LikeList;
use App\Models\Post;
use App\Models\StudyGroup;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SupportController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use App\Livewire\ParticipationList;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportLostController;
use App\Models\ReportLost;
use App\Http\Controllers\ParkingSpotsController;
use Laravel\Jetstream\Http\Controllers\Livewire\PrivacyPolicyController;
use Laravel\Jetstream\Http\Controllers\Livewire\TermsOfServiceController;
use Laravel\Jetstream\Http\Controllers\Livewire\UserProfileController;

Route::get('/parking-map', [MapController::class, 'index'])->name('map.show');


//Auth with Google and Facebook
Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');

Route::get('/auth/facebook/redirect', [FacebookController::class, 'redirect'])
    ->name('facebook.redirect');

Route::get('/auth/facebook/callback', [FacebookController::class, 'callback'])
    ->name('facebook.callback');

    Route::get('/terms-of-service', [TermsOfServiceController::class, 'show'])->name('terms.show');
Route::get('/privacy-policy', [PrivacyPolicyController::class, 'show'])->name('policy.show');

Route::get('/', [PostController::class, 'getAllPosts'])->name('dashboard.all.posts');

// routes/web.php
Route::middleware('auth')->delete('/delete-account', function () {
    $user = Auth::user();
    Auth::logout();
    $user->delete();
    return redirect('/')->with('status', 'Account deleted successfully.');
})->name('account.delete');

Route::middleware(['auth', 'verified'])->group(function () {


    //Search Route
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    Route::get('/search/result', [SearchController::class, 'search'])->name('search.results');

    Route::get('/search-results', [SearchController::class, 'getSearchResults'])->name('search.getResults');



    //Profile Routes
    Route::get('/profile/@{name}/edit', [UserController::class, 'edit'])->name('profile.edit');

    Route::get('/profile/@{name}', [PostController::class, 'show'])->name('profile.personal.page');

    Route::get('profile/@{name}/posts', [PostController::class, 'allPosts'])->name('posts.all');

    Route::get('profile/@{name}/saved-posts', [PostController::class, 'savedPosts'])->name('posts.saved');

    Route::get('profile/@{name}/liked-posts', [PostController::class, 'moveToLikedPosts'])->name('posts.liked');

    // Notification Route
    Route::get('/notifications', [NotificationController::class, 'notifications'])->name('notifications');

    //Post Routes
    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

    Route::get('post/create', function () {
        return view('create-post');
    })->name('post.create');

    Route::get('/post/{post:slug}/edit', [PostController::class, 'edit'])->name('post.edit');

    Route::put('/post/{post:slug}/update', [PostController::class, 'update'])->name('post.update');

    Route::delete('/dashboard/post/{post:slug}/delete', [PostController::class, 'destroy'])->name('post.destroy');

    Route::get('/dashboard/post/{slug}', [PostController::class, 'singlePost'])->name('single-post');

    // Help & Support Route
    // throttle middleware to limit requests how many times user can call this route in the given time period and in this case 5 times in 1 minute
    Route::get('/help-support/@{name}', [SupportController::class, 'supportRoute'])->name('help-support');
    Route::post('/help-support/submit', [SupportController::class, 'submitSupportRequest'])->name('support.submit')->middleware('throttle:5,1');

    //Users who liked a specific post
    Route::get('/dashboard/{post:slug}/liked-users', [LikeList::class, 'getLikedUsers'])->name('likedUsers');

    //Follower List
    Route::get('profile/@{name}/followers', [FollowController::class, 'getFollowers'])->name('follower.list');

    //Following List
    Route::get('profile/@{name}/followings', [FollowController::class, 'getFollowings'])->name('followings.list');

    //Lost and Found Routes

    Route::get('/lost-found', [ReportLostController::class, 'index'])->name('lost-found');

    Route::get('/lost-found/contact-form/{reportLost:slug}', action: function (ReportLost $reportLost) {
        return view('contact-form', compact('reportLost'));
    })->name('contact-form');

    
    Route::get('/lost-found/report-lost', function () {
        return view('report-lost');
    })->name('report-lost');


    Route::get('/lost-found/{reportLost:slug}', [ReportLostController::class, 'show'])
    ->name('lost-report.show');

    Route::get('/profile/@{name}/lost-items', [ReportLostController::class, 'userLostItems'])->name('lost.items');


    Route::post('/contact-lost-report/{reportLost:id}', [ReportLostController::class, 'contact'])->name('contact-lost-report');
    // Mark a lost report as found (owner only)
    Route::post('/lost-found/{reportLost:id}/found', [ReportLostController::class, 'markFound'])->name('report-lost.markFound');

    Route::post('/lost-found/lost-report', [ReportLostController::class, 'store'])
        ->name('lost-report');

    Route::delete('/lost-found/report-lost/{reportLost:slug}/delete', [ReportLostController::class, 'destroy'])->name('report-lost.delete');

    
    // Study Group Routes

    Route::get('/study-groups', [StudyGroupController::class, 'index'])->name('study-groups');

    Route::get('/study-groups/create-group', function () {
        return view('create-study-group');
    })->name('study-groups.create');

    Route::get('/study-groups/edit/{studyGroup:slug}', [StudyGroupController::class, 'edit'])->name('study-groups.edit');

    Route::get('/study-groups/{studyGroup:slug}', [StudyGroupController::class, 'show'])->name('study-groups.show');

    Route::post('/study-groups/store', [StudyGroupController::class, 'store'])->name('study-groups.store');

    Route::put('/study-group/update/{studyGroup:slug}', [StudyGroupController::class, 'update'])->name('study-groups.update');

    Route::get('/profile/@{name}/study-groups', [StudyGroupController::class, 'userStudyGroups'])->name('study.groups.currently.in');

    Route::delete('/study-group/delete/{studyGroup:slug}', [StudyGroupController::class, 'destroy'])->name('study-group.destroy');

    //phpinfo Route
    
    Route::get('/phpinfo', function () {
        return view('phpinfo');
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/followings-posts', [PostController::class, 'getFollowingsPosts'])->middleware(['auth'])->name('dashboard.followings.posts');

    Route::get('/top-liked', [PostController::class, 'topLikedPosts'])->middleware(['auth'])->name('dashboard.top.liked');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// For viewing your own profile
Route::get('/user/profile', [UserProfileController::class, 'show'])->name('profile.show');

