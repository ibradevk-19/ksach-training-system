<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'full_name',
        'national_id',
        'phone_1',
        'phone_2',
        'gender',
        'birth_date',
        'governorate_id',
        'displacement_status',
        'residence_type_id',
        'current_address',
        'family_members_count',
        'breadwinner_status',
        'employment_status',
        'income_type_id',
        'education_level',
        'specialization',
        'health_status',
        'identity_image',
        'medical_report',
        'education_certificate',
        'is_active',
        'notes',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function residenceType()
    {
        return $this->belongsTo(ResidenceType::class);
    }

    public function incomeType()
    {
        return $this->belongsTo(IncomeType::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}