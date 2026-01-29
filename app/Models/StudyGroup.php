<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class StudyGroup extends Model
{
    protected $fillable = [
        'leader_id',
        'group_name',
        'subject',
        'slug',
        'description',
        'location',
        'date',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'date'       => 'date',
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($studyGroup) {
            // only if slug is empty
            if (empty($studyGroup->slug)) {
                $studyGroup->slug = Str::random(45); // random, shareable, unique
            }
        });
    }

    // Get all the groups that user has joined
    public function joinedGroups()
    {
        return $this->belongsToMany(User::class, 'study_group_members')->withTimestamps();
    }


    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function members()
    {
        return $this->belongsToMany(
            User::class,
            'study_group_members', // 👈 pivot table name
            'study_group_id',
            'user_id'
        )->withTimestamps();
    }


}
