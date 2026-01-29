<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ReportLost extends Model
{
    protected $fillable = [
        'user_id',
        'item_name',
        'slug',
        'detailed_description',
        'date_lost',
        'time_from_lost',
        'time_to_lost',
        'location_lost',
        'images_lost',
        'found',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contacts()
    {
        return $this->hasMany(ContactLostReport::class);
    }

    protected static function booted()
    {
        static::creating(function ($post) {
            // only if slug is empty
            if (empty($post->slug)) {
                $post->slug = Str::random(32); // random, shareable, unique
            }
        });
    }

    public function getTimeAgoAttribute()
    {
        return str_replace(' ago', '', $this->created_at->diffForHumans(['short' => true]));
    }


    protected $casts = [
        'images_lost' => 'array',
        'date_lost' => 'date',
        'found' => 'boolean',
        'time_from_lost' => 'datetime:H:i:s',
        'time_to_lost' => 'datetime:H:i:s',
    ];

    
}
