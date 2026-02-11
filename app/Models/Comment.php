<?php

namespace App\Models;

use Usamamuneerchaudhary\Commentify\Models\Comment as BaseComment;

// We created this, so that on admin panel it can easily access all that stuff from vendor
class Comment extends BaseComment
{
    public function getTimeAgoAttribute()
    {
        return str_replace(' ago', '', $this->created_at->diffForHumans(['short' => true]));
    }

}
