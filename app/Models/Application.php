<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'applicant_id',
        'track_id',
        'application_number',
        'status',
        'score',
        'notes',
        'created_by',
        'reviewed_by',
        'submitted_at',
        'reviewed_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function answers()
    {
        return $this->hasMany(ApplicationAnswer::class);
    }

    public function files()
    {
        return $this->hasMany(ApplicationFile::class);
    }

    public function review()
    {
        return $this->hasOne(ApplicationReview::class);
    }
}