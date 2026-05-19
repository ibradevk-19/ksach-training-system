<?php

namespace Database\Seeders;

use App\Models\EligibilityRule;
use App\Models\ScoringRule;
use App\Models\Track;
use Illuminate\Database\Seeder;

class ReviewRulesSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Track::all() as $track) {

            EligibilityRule::updateOrCreate(
                [
                    'track_id' => $track->id,
                    'field_name' => 'training_commitment',
                    'source' => 'answer',
                ],
                [
                    'operator' => '=',
                    'expected_value' => ['نعم'],
                    'failure_message' => 'المتقدم غير مستعد للالتزام بالتدريب.',
                    'is_active' => true,
                ]
            );

            if ($track->gender !== 'both') {
                EligibilityRule::updateOrCreate(
                    [
                        'track_id' => $track->id,
                        'field_name' => 'gender',
                        'source' => 'applicant',
                    ],
                    [
                        'operator' => '=',
                        'expected_value' => [$track->gender],
                        'failure_message' => 'جنس المتقدم لا يتوافق مع شروط المسار.',
                        'is_active' => true,
                    ]
                );
            }

            $this->scoring($track);
        }
    }

    private function scoring(Track $track): void
    {
        $rules = [
            ['answer', 'displacement_status', '=', ['نازح'], 10],
            ['answer', 'monthly_income', '=', ['معدوم الدخل'], 20],
            ['answer', 'monthly_income', '=', ['أقل من 500 شيكل'], 15],
            ['answer', 'employment_status', '=', ['لا يعمل / لا تعمل'], 15],
            ['answer', 'health_status', '=', ['ذوي إعاقة'], 15],
            ['answer', 'training_commitment', '=', ['نعم'], 10],
            ['answer', 'has_previous_experience', '=', ['نعم'], 5],
        ];

        foreach ($rules as [$source, $field, $operator, $expected, $score]) {
            ScoringRule::updateOrCreate(
                [
                    'track_id' => $track->id,
                    'field_name' => $field,
                    'source' => $source,
                    'operator' => $operator,
                ],
                [
                    'expected_value' => $expected,
                    'score' => $score,
                    'is_active' => true,
                ]
            );
        }

        foreach ($this->skillRulesForTrack($track->title) as $field) {
            ScoringRule::updateOrCreate(
                [
                    'track_id' => $track->id,
                    'field_name' => $field,
                    'source' => 'answer',
                    'operator' => 'in',
                ],
                [
                    'expected_value' => ['مرتفع', 'مرتفعة', 'عالي', 'عالية', 'ممتاز', 'بدرجة كبيرة'],
                    'score' => 10,
                    'is_active' => true,
                ]
            );
        }
    }

    private function skillRulesForTrack(string $title): array
    {
        return match ($title) {
            'مسار الحلاقة الرجالية' => [
                'barber_passion',
                'barber_tools_skill',
                'customer_service_skill',
                'new_techniques_readiness',
            ],

            'مسار التجميل النسائي - كوافير' => [
                'beauty_passion',
                'hand_accuracy_patience',
                'color_hair_harmony',
                'learn_new_styles',
            ],

            'مسار التطريز' => [
                'handcraft_passion',
                'embroidery_accuracy_patience',
                'needle_thread_control',
                'learning_ability',
                'pattern_following_accuracy',
            ],

            'مسار صناعة الاكسسوارات والأشغال اليدوية' => [
                'accessories_passion_creativity',
                'small_tools_control',
                'fine_details_work',
                'fashion_following',
            ],

            'مسار التصميم الجرافيكي' => [
                'graphic_creativity',
                'design_software_skill',
                'digital_drawing_tools',
                'digital_art_passion',
            ],

            'مسار التسويق الرقمي' => [
                'digital_passion',
                'computer_internet_skill',
                'digital_marketing_tools',
                'marketing_ideas_expression',
                'learn_digital_tools_fast',
            ],

            'مسار المساعد الافتراضي وإدارة الأعمال عن بعد' => [
                'office_computer_skill',
                'organization_time_management',
                'fast_learning',
                'basic_digital_tools',
            ],

            'مسار الترجمة والعمل الحر الرقمي' => [
                'english_level',
                'translation_tools_skill',
                'freelance_platforms_skill',
                'time_management_tasks',
                'self_work_ability',
                'client_communication',
                'email_social_drive_skill',
            ],

            default => [],
        };
    }
}