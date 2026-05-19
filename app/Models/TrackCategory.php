<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}