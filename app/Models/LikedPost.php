<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikedPost extends Model
{
    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
