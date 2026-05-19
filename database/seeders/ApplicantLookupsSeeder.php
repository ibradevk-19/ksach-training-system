<?php

namespace Database\Seeders;

use App\Models\Governorate;
use App\Models\IncomeType;
use App\Models\ResidenceType;
use Illuminate\Database\Seeder;

class ApplicantLookupsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['رفح', 'خانيونس', 'الوسطى', 'غزة', 'الشمال'] as $name) {
            Governorate::firstOrCreate(['name' => $name], ['status' => true]);
        }

        foreach (['منزل', 'مخيم إيواء', 'خيمة'] as $name) {
            ResidenceType::firstOrCreate(['name' => $name], ['status' => true]);
        }

        foreach ([
            'معدوم الدخل',
            'أقل من 500 شيكل',
            'من 500 شيكل حتى 1000 شيكل',
            'أكثر من 1000 شيكل',
        ] as $name) {
            IncomeType::firstOrCreate(['name' => $name], ['status' => true]);
        }
    }
}