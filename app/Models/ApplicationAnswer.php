<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAnswer extends Model
{
    protected $fillable = [
        'application_id',
        'form_field_id',
        'answer',
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function field()
    {
        return $this->belongsTo(FormField::class, 'form_field_id');
    }
}