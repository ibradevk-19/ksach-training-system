<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'track_id',
        'title',
        'description',
        'is_multi_step',
        'status',
    ];

    protected $casts = [
        'is_multi_step' => 'boolean',
        'status' => 'boolean',
    ];

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function sections()
    {
        return $this->hasMany(FormSection::class)->orderBy('sort_order');
    }

    public function fields()
    {
        return $this->hasMany(FormField::class)->orderBy('sort_order');
    }
}