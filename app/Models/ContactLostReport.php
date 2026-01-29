<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactLostReport extends Model
{
    protected $fillable = [
        'user_id',
        'reported_lost_id',
        'item_name',
        'detailed_description',
        'date_found',
        'location_found',
        'images_found',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reportLost()
    {
        return $this->belongsTo(ReportLost::class, 'reported_lost_id');
    }

    protected $casts = [
        'images_found' => 'array',
    ];
}
