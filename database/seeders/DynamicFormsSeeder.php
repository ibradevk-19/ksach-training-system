<?php

namespace Database\Seeders;

use App\Models\Form;
use App\Models\FormField;
use App\Models\FormSection;
use App\Models\Track;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DynamicFormsSeeder extends Seeder
{
    public function run(): void
    {
        $tracks = Track::all()->keyBy('title');

        foreach ($this->formsData() as $trackTitle => $data) {
            $track = $tracks->get($trackTitle);

            if (! $track) {
                continue;
            }

            $form = Form::updateOrCreate(
                ['track_id' => $track->id],
                [
                    'title' => 'نموذج التقديم - ' . $track->title,
                    'description' => 'نموذج خاص للتقديم على ' . $track->title,
                    'is_multi_step' => true,
                    'status' => true,
                ]
            );

            foreach ($this->commonSections($form->id) as $sectionData) {
                $section = FormSection::updateOrCreate(
                    [
                        'form_id' => $form->id,
                        'title' => $sectionData['title'],
                    ],
                    [
                        'description' => $sectionData['description'] ?? null,
                        'sort_order' => $sectionData['sort_order'],
                    ]
                );

                foreach ($sectionData['fields'] as $field) {
                    $this->createField($form->id, $section->id, $field);
                }
            }

            $skillSection = FormSection::updateOrCreate(
                [
                    'form_id' => $form->id,
                    'title' => 'معايير ومهارات خاصة بالمسار',
                ],
                [
                    'description' => 'أسئلة تقييمية خاصة بهذا المسار.',
                    'sort_order' => 5,
                ]
            );

            foreach ($data['skill_fields'] as $field) {
                $this->createField($form->id, $skillSection->id, $field);
            }
        }
    }

    private function commonSections(int $formId): array
    {
        return [
            [
                'title' => 'البيانات الشخصية',
                'description' => 'البيانات الأساسية للمتقدم.',
                'sort_order' => 1,
                'fields' => [
                    $this->field('الاسم الرباعي', 'full_name', 'text', true, 12, null, 'max:255'),
                    $this->field('رقم الهوية', 'national_id', 'text', true, 6, null, 'max:20'),
                    $this->field('رقم تواصل 1', 'phone_1', 'text', true, 6, null, 'max:20'),
                    $this->field('رقم تواصل 2', 'phone_2', 'text', false, 6, null, 'max:20'),
                    $this->field('الجنس', 'gender', 'radio', true, 6, ['ذكر', 'أنثى']),
                    $this->field('الفئة العمرية', 'age_group', 'select', true, 6, [
                        '18 سنة حتى أقل من 30 سنة',
                        '30 حتى أقل من 40 سنة',
                        '40 سنة حتى أقل من 50 سنة',
                        '50 سنة حتى 60 سنة',
                    ]),
                ],
            ],
            [
                'title' => 'بيانات السكن والأسرة',
                'description' => 'بيانات الإقامة والوضع الأسري.',
                'sort_order' => 2,
                'fields' => [
                    $this->field('المحافظة الحالية', 'governorate', 'select', true, 6, [
                        'رفح',
                        'خانيونس',
                        'الوسطى',
                        'غزة',
                        'الشمال',
                    ]),
                    $this->field('الإقامة', 'displacement_status', 'radio', true, 6, [
                        'مقيم',
                        'نازح',
                    ]),
                    $this->field('مكان الإقامة الحالي', 'residence_type', 'radio', true, 6, [
                        'منزل',
                        'مخيم إيواء',
                        'خيمة',
                    ]),
                    $this->field('عنوان السكن الحالي بالتفصيل', 'current_address', 'textarea', true, 12),
                    $this->field('عدد أفراد الأسرة', 'family_members_count', 'number', true, 6, null, 'min:0|max:100'),
                    $this->field('معيل الأسرة', 'breadwinner_status', 'select', true, 6, [
                        'الزوج',
                        'أرملة',
                        'مطلقة',
                        'أخرى',
                    ]),
                ],
            ],
            [
                'title' => 'البيانات الاقتصادية والتعليمية والصحية',
                'description' => 'بيانات العمل والدخل والتعليم والصحة.',
                'sort_order' => 3,
                'fields' => [
                    $this->field('حالة العمل', 'employment_status', 'radio', true, 6, [
                        'يعمل / تعمل',
                        'لا يعمل / لا تعمل',
                    ]),
                    $this->field('مستوى الدخل الشهري', 'monthly_income', 'select', true, 6, [
                        'معدوم الدخل',
                        'أقل من 500 شيكل',
                        'من 500 شيكل حتى 1000 شيكل',
                        'أكثر من 1000 شيكل',
                    ]),
                    $this->field('المستوى التعليمي', 'education_level', 'select', true, 6, [
                        'بدون',
                        'شهادة ثالث إعدادي',
                        'ثانوية عامة',
                        'بكالوريوس',
                        'ماجستير فأعلى',
                    ]),
                    $this->field('التخصص', 'specialization', 'text', false, 6, null, 'max:255'),
                    $this->field('الوضع الصحي للمتقدم', 'health_status', 'radio', true, 6, [
                        'سليم / سليمة',
                        'ذوي إعاقة',
                    ]),
                    $this->field('الاستعداد والالتزام لتلقي 130 ساعة تدريبية', 'training_commitment', 'radio', true, 6, [
                        'نعم',
                        'لا',
                    ]),
                    $this->field('وجود خبرة سابقة', 'has_previous_experience', 'radio', true, 6, [
                        'نعم',
                        'لا',
                    ]),
                ],
            ],
            [
                'title' => 'المرفقات',
                'description' => 'الوثائق المطلوبة.',
                'sort_order' => 4,
                'fields' => [
                    $this->field('صورة الهوية', 'identity_image', 'file', true, 6),
                    $this->field('صورة التقرير الطبي إن وجد', 'medical_report', 'file', false, 6),
                    $this->field('الشهادة العلمية للمسارات التقنية', 'education_certificate', 'file', false, 6),
                ],
            ],
        ];
    }

    private function formsData(): array
    {
        return [
            'مسار الحلاقة الرجالية' => [
                'skill_fields' => [
                    $this->field('الشغف وحب فن الحلاقة والعناية بالمظهر الرجالي', 'barber_passion', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('المهارة في التعامل بالمقص وماكنة الحلاقة', 'barber_tools_skill', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('التعامل مع الزبائن بأسلوب لبق ومهني', 'customer_service_skill', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('الاستعداد لتعلم تقنيات جديدة وتجربة أدوات مختلفة', 'new_techniques_readiness', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                ],
            ],

            'مسار التجميل النسائي - كوافير' => [
                'skill_fields' => [
                    $this->field('الاهتمام والشغف بالتجميل', 'beauty_passion', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('الدقة في استخدام اليدين والصبر في العمل', 'hand_accuracy_patience', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('وجود حس بالتناسق في الألوان وتصفيف الشعر', 'color_hair_harmony', 'radio', true, 6, ['ممتاز', 'جيد', 'ضعيف']),
                    $this->field('القدرة على تعلم قصات وصبغات وتسريحات جديدة', 'learn_new_styles', 'radio', true, 6, ['بدرجة كبيرة', 'بدرجة متوسطة', 'بدرجة ضعيفة']),
                ],
            ],

            'مسار التطريز' => [
                'skill_fields' => [
                    $this->field('الاهتمام والشغف بالفن اليدوي', 'handcraft_passion', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('الدقة والصبر في العمل', 'embroidery_accuracy_patience', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('مستوى التحكم بالإبرة والخيط', 'needle_thread_control', 'radio', true, 6, ['ممتاز', 'جيد', 'ضعيف']),
                    $this->field('القدرة على التعلم', 'learning_ability', 'radio', true, 6, ['بدرجة كبيرة', 'بدرجة متوسطة', 'بدرجة ضعيفة']),
                    $this->field('القدرة على رسم أو تتبع النماذج بدقة', 'pattern_following_accuracy', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                ],
            ],

            'مسار صناعة الاكسسوارات والأشغال اليدوية' => [
                'skill_fields' => [
                    $this->field('الشغف والاهتمام بالمجال والقدرة على ابتكار تصاميم جديدة', 'accessories_passion_creativity', 'radio', true, 6, ['عالي', 'متوسط', 'ضعيف']),
                    $this->field('التحكم الجيد بالأصابع والأدوات الصغيرة', 'small_tools_control', 'radio', true, 6, ['عالية', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على العمل على التفاصيل الدقيقة', 'fine_details_work', 'radio', true, 6, ['عالي', 'متوسط', 'ضعيف']),
                    $this->field('متابعة الموضة في الاكسسوارات', 'fashion_following', 'radio', true, 6, ['عالية', 'متوسطة', 'ضعيف']),
                ],
            ],

            'مسار التصميم الجرافيكي' => [
                'skill_fields' => [
                    $this->field('القدرة على ابتكار أفكار جديدة لتصميم الشعارات والإعلانات والمواد المرئية', 'graphic_creativity', 'radio', true, 6, ['عالية', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على استخدام برامج التصميم الأساسية', 'design_software_skill', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('المعرفة بأدوات الرسم الرقمي مثل Figma و Procreate', 'digital_drawing_tools', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('حب الرسم والتصميم والفنون الرقمية', 'digital_art_passion', 'radio', true, 6, ['عالية', 'متوسطة', 'ضعيفة']),
                ],
            ],

            'مسار التسويق الرقمي' => [
                'skill_fields' => [
                    $this->field('الشغف والاهتمام بالمجال الرقمي', 'digital_passion', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('القدرة على استخدام الحاسوب وبرامج الإنترنت', 'computer_internet_skill', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('المعرفة بأدوات التسويق الرقمي مثل Google Analytics و Google Ads و Meta Ads Manager', 'digital_marketing_tools', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على التعبير عن الأفكار التسويقية ببساطة', 'marketing_ideas_expression', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على تعلم أدوات رقمية جديدة بسرعة', 'learn_digital_tools_fast', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                ],
            ],

            'مسار المساعد الافتراضي وإدارة الأعمال عن بعد' => [
                'skill_fields' => [
                    $this->field('القدرة على استخدام الحاسوب وبرامج المكاتب', 'office_computer_skill', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('مهارات التنظيم وإدارة الوقت', 'organization_time_management', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على التعلم السريع', 'fast_learning', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('الإلمام بالأدوات الرقمية الأساسية مثل البريد الإلكتروني و Trello و Zoom و Google Meet', 'basic_digital_tools', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                ],
            ],

            'مسار الترجمة والعمل الحر الرقمي' => [
                'skill_fields' => [
                    $this->field('تمكن وفهم قوي للغة الإنجليزية', 'english_level', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على استخدام أدوات الترجمة المساعدة', 'translation_tools_skill', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على التعامل مع منصات العمل الحر مثل Upwork و Fiverr و Freelancer', 'freelance_platforms_skill', 'radio', true, 6, ['مرتفعة', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على تنظيم الوقت بين المهام المختلفة', 'time_management_tasks', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('القدرة على العمل بدون إشراف مباشر', 'self_work_ability', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                    $this->field('القدرة على التواصل مع العملاء', 'client_communication', 'radio', true, 6, ['عالية', 'متوسطة', 'ضعيفة']),
                    $this->field('القدرة على استخدام البريد الإلكتروني وأدوات التواصل الاجتماعي و Google Drive', 'email_social_drive_skill', 'radio', true, 6, ['مرتفع', 'متوسط', 'ضعيف']),
                ],
            ],
        ];
    }

    private function field(
        string $label,
        string $name,
        string $type,
        bool $required = false,
        int $width = 12,
        ?array $options = null,
        ?string $validationRules = null
    ): array {
        return [
            'label' => $label,
            'name' => $name,
            'type' => $type,
            'is_required' => $required,
            'width' => $width,
            'options' => $options,
            'validation_rules' => $validationRules,
        ];
    }

    private function createField(int $formId, int $sectionId, array $field): void
    {
        FormField::updateOrCreate(
            [
                'form_id' => $formId,
                'name' => $field['name'],
            ],
            [
                'form_section_id' => $sectionId,
                'label' => $field['label'],
                'type' => $field['type'],
                'placeholder' => $field['placeholder'] ?? null,
                'options' => $field['options'] ?? null,
                'is_required' => $field['is_required'] ?? false,
                'validation_rules' => $field['validation_rules'] ?? null,
                'width' => $field['width'] ?? 12,
                'sort_order' => $field['sort_order'] ?? 0,
                'status' => true,
            ]
        );
    }
}