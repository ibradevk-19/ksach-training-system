<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'form_id',
        'form_section_id',
        'label',
        'name',
        'type',
        'placeholder',
        'options',
        'is_required',
        'validation_rules',
        'width',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'options' => 'array',
        'is_required' => 'boolean',
        'status' => 'boolean',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function section()
    {
        return $this->belongsTo(FormSection::class, 'form_section_id');
    }

    public function answers()
    {
        return $this->hasMany(ApplicationAnswer::class);
    }
}