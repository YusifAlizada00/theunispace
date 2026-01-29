<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\Contracts\EmailVerificationNotificationSentResponse;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Usamamuneerchaudhary\Commentify\Traits\HasUserAvatar;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Auth;



    class User extends Authenticatable implements MustVerifyEmail, FilamentUser
    {
        use HasApiTokens;
        
        /** @use HasFactory<\Database\Factories\UserFactory> */
        use HasFactory;
        use HasUserAvatar;
        use HasProfilePhoto;
        use Notifiable;
        use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'slug',
        'password',
        'photo',
        'google_id',
        'facebook_id',
        'major',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //     protected static function booted()
    // {
    //     static::creating(function ($user) {
    //         $user->slug = Str::slug($user->name) . '-' . Str::random(5);
    //     });
    // }
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->is_admin ? true : abort(404, 'Not Found');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function followers()
    {
        // People who follow *me* (My Followers)
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id')->withTimestamps();
    }

    public function following()
    {
        // People who I follow
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id')->withTimestamps();
    }

    public function follows(User $user)
    {
        return $this->following()->where('following_id', $user->id)->exists();
    }

    public function savedPost()
    {
        return $this->belongsToMany(Post::class, 'saved_posts')->withTimestamps();
    }

    public function likedPost()
    {
        return $this->belongsToMany(Post::class, 'liked_posts')->withTimestamps();
    }

    public function studyGroupsLeader()
    {
        return $this->hasMany(StudyGroup::class, 'leader_id');
    }

    public function studyGroups()
    {
        return $this->belongsToMany(StudyGroup::class)
            ->withTimestamps();
    }

    public function joinedGroups()
    {
        return $this->belongsToMany(StudyGroup::class, 'study_group_members')->withTimestamps();
    }
}
