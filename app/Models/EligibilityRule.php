<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EligibilityRule extends Model
{
    protected $fillable = [
        'track_id',
        'field_name',
        'source',
        'operator',
        'expected_value',
        'failure_message',
        'is_active',
    ];

    protected $casts = [
        'expected_value' => 'array',
        'is_active' => 'boolean',
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }
}