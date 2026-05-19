<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationFile extends Model
{
    protected $fillable = [
        'application_id',
        'form_field_id',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
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