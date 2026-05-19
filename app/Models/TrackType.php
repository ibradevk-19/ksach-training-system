<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackType extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'description',
        'status',
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}