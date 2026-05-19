<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationReview extends Model
{
    protected $fillable = [
        'application_id',
        'reviewed_by',
        'eligibility_status',
        'auto_score',
        'manual_score',
        'final_score',
        'passed_rules',
        'failed_rules',
        'notes',
        'reviewed_at',
    ];

    protected $casts = [
        'passed_rules' => 'array',
        'failed_rules' => 'array',
        'reviewed_at' => 'datetime',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}