<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportContent extends Model
{
    protected $fillable = [
        'reporter_id',
        'reported_post_id',
        'reasons',
        'additional_info',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }
}
