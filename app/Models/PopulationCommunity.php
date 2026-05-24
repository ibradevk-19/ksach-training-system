<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopulationCommunity extends Model
{
    protected $fillable = [
        'governorate_id',
        'name',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }
}
