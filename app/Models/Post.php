<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Usamamuneerchaudhary\Commentify\Traits\Commentable;
use Illuminate\Support\Str;
use App\Models\PostMedia;


class Post extends Model    
{
    use HasFactory;
    use Commentable;


    protected $fillable = [
        'description',
        'slug',
        'user_id',
    ];

     protected static function booted()
    {
        static::creating(function ($post) {
            // only if slug is empty
            if (empty($post->slug)) {
                $post->slug = Str::random(26); // random, shareable, unique
            }
        });
    }

    public function getTimeAgoAttribute()
    {
        return str_replace(' ago', '', $this->created_at->diffForHumans(['short' => true]));
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'liked_posts')->withTimestamps();
    }

    public function media()
{
    return $this->hasMany(PostMedia::class);
}


}


