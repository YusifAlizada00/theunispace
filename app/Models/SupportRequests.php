<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportRequests extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'type',
        'page',
        'solution_steps',
        'feature',
        'suggestions',
        'subject',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
