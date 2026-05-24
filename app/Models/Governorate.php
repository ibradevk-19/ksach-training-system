<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    public function populationCommunities()
    {
        return $this->hasMany(PopulationCommunity::class);
    }
}
