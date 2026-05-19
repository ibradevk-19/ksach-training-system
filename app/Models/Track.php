<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'track_type_id',
        'track_category_id',
        'title',
        'slug',
        'short_description',
        'description',
        'thumbnail',
        'start_date',
        'end_date',
        'registration_start',
        'registration_end',
        'seats',
        'gender',
        'min_age',
        'max_age',
        'allow_waiting_list',
        'requires_review',
        'status',
        'is_featured',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'registration_start' => 'date',
        'registration_end' => 'date',
        'allow_waiting_list' => 'boolean',
        'requires_review' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function type()
    {
        return $this->belongsTo(TrackType::class, 'track_type_id');
    }

    public function category()
    {
        return $this->belongsTo(TrackCategory::class, 'track_category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function acceptedApplications()
    {
        return $this->hasMany(Application::class)
            ->where('status', 'accepted');
    }

    public function form()
    {
        return $this->hasOne(Form::class);
    }

    public function eligibilityRules()
    {
        return $this->hasMany(EligibilityRule::class);
    }

    public function scoringRules()
    {
        return $this->hasMany(ScoringRule::class);
    }

   
}