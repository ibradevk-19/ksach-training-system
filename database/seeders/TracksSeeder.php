<?php

namespace Database\Seeders;

use App\Models\Track;
use App\Models\TrackCategory;
use App\Models\TrackType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TracksSeeder extends Seeder
{
    public function run(): void
    {
        $trainingType = TrackType::firstOrCreate(
            ['slug' => 'training'],
            [
                'name' => 'برنامج تدريبي',
                'icon' => 'ti ti-school',
                'color' => '#206bc4',
                'description' => 'برامج ومسارات تدريبية مهنية وتقنية',
                'status' => true,
            ]
        );

        $vocationalCategory = TrackCategory::firstOrCreate(
            ['name' => 'المسارات المهنية والحرفية'],
            [
                'description' => 'مسارات تدريبية مهنية وحرفية تستهدف اكتساب مهارات عملية قابلة للتشغيل.',
                'status' => true,
            ]
        );

        $digitalCategory = TrackCategory::firstOrCreate(
            ['name' => 'المسارات التقنية والرقمية'],
            [
                'description' => 'مسارات تدريبية تقنية ورقمية تساعد على العمل الحر والعمل عن بعد.',
                'status' => true,
            ]
        );

        $tracks = [
            [
                'title' => 'مسار الحلاقة الرجالية',
                'category_id' => $vocationalCategory->id,
                'seats' => 200,
                'gender' => 'male',
                'min_age' => 18,
                'max_age' => 49,
                'short_description' => 'تدريب مهني في الحلاقة الرجالية والعناية بالمظهر الرجالي.',
                'description' => 'مسار خاص بالرجال فقط، مكان التدريب في مدينة دير البلح، ويتضمن 130 ساعة تدريبية مع التركيز على مهارات الحلاقة والتعامل مع الزبائن وتعلم التقنيات الجديدة.',
            ],
            [
                'title' => 'مسار التجميل النسائي - كوافير',
                'category_id' => $vocationalCategory->id,
                'seats' => 200,
                'gender' => 'female',
                'min_age' => 18,
                'max_age' => 49,
                'short_description' => 'تدريب مهني في التجميل النسائي وتصفيف الشعر.',
                'description' => 'مسار خاص بالنساء فقط، مكان التدريب في مدينة دير البلح، ويتضمن 130 ساعة تدريبية في التجميل، تصفيف الشعر، القصات، الصبغات، والتسريحات.',
            ],
            [
                'title' => 'مسار التطريز',
                'category_id' => $vocationalCategory->id,
                'seats' => 200,
                'gender' => 'female',
                'min_age' => 18,
                'max_age' => 60,
                'short_description' => 'تدريب مهني في التطريز والفن اليدوي.',
                'description' => 'مسار خاص بالنساء فقط، مكان التدريب في مدينة دير البلح، ويتضمن 130 ساعة تدريبية في التطريز، التحكم بالإبرة والخيط، تتبع النماذج، والدقة في العمل.',
            ],
            [
                'title' => 'مسار صناعة الاكسسوارات والأشغال اليدوية',
                'category_id' => $vocationalCategory->id,
                'seats' => 200,
                'gender' => 'female',
                'min_age' => 18,
                'max_age' => 60,
                'short_description' => 'تدريب مهني في صناعة الاكسسوارات والأعمال اليدوية.',
                'description' => 'مسار خاص بالنساء فقط، مكان التدريب في مدينة دير البلح، ويتضمن 130 ساعة تدريبية في صناعة الاكسسوارات، الخرز، الأسلاك، اللواصق، والتصاميم اليدوية.',
            ],
            [
                'title' => 'مسار التصميم الجرافيكي',
                'category_id' => $digitalCategory->id,
                'seats' => 50,
                'gender' => 'both',
                'min_age' => 18,
                'max_age' => 60,
                'short_description' => 'تدريب تقني في التصميم الجرافيكي والمواد المرئية.',
                'description' => 'مسار للنساء والرجال، مكان التدريب في مدينة دير البلح، ويتطلب مستوى تعليمي بكالوريوس فأعلى، ويركز على التصميم، الشعارات، الإعلانات، Photoshop، Illustrator، InDesign، Figma، وProcreate.',
            ],
            [
                'title' => 'مسار التسويق الرقمي',
                'category_id' => $digitalCategory->id,
                'seats' => 50,
                'gender' => 'both',
                'min_age' => 18,
                'max_age' => 60,
                'short_description' => 'تدريب تقني في التسويق الرقمي وإدارة الحملات.',
                'description' => 'مسار للنساء والرجال، مكان التدريب في مدينة دير البلح، ويتطلب مستوى تعليمي بكالوريوس فأعلى، ويركز على أدوات التسويق الرقمي مثل Google Analytics وGoogle Ads وMeta Ads Manager.',
            ],
            [
                'title' => 'مسار المساعد الافتراضي وإدارة الأعمال عن بعد',
                'category_id' => $digitalCategory->id,
                'seats' => 50,
                'gender' => 'both',
                'min_age' => 18,
                'max_age' => 60,
                'short_description' => 'تدريب تقني في إدارة الأعمال عن بعد والعمل كمساعد افتراضي.',
                'description' => 'مسار للنساء والرجال، مكان التدريب في مدينة دير البلح، ويتطلب مستوى تعليمي بكالوريوس فأعلى، ويركز على استخدام الحاسوب، برامج المكاتب، إدارة الوقت، البريد الإلكتروني، Trello، Zoom، وGoogle Meet.',
            ],
            [
                'title' => 'مسار الترجمة والعمل الحر الرقمي',
                'category_id' => $digitalCategory->id,
                'seats' => 50,
                'gender' => 'both',
                'min_age' => 18,
                'max_age' => 60,
                'short_description' => 'تدريب تقني في الترجمة والعمل الحر الرقمي.',
                'description' => 'مسار للنساء والرجال، مكان التدريب في مدينة دير البلح، ويتطلب مستوى تعليمي بكالوريوس فأعلى، ويركز على اللغة الإنجليزية، أدوات الترجمة، منصات العمل الحر مثل Upwork وFiverr وFreelancer، والتواصل مع العملاء.',
            ],
        ];

        foreach ($tracks as $track) {
            Track::updateOrCreate(
                ['slug' => Str::slug($track['title']) ?: md5($track['title'])],
                [
                    'track_type_id' => $trainingType->id,
                    'track_category_id' => $track['category_id'],
                    'title' => $track['title'],
                    'short_description' => $track['short_description'],
                    'description' => $track['description'],
                    'seats' => $track['seats'],
                    'gender' => $track['gender'],
                    'min_age' => $track['min_age'],
                    'max_age' => $track['max_age'],
                    'allow_waiting_list' => true,
                    'requires_review' => true,
                    'status' => 'published',
                    'is_featured' => false,
                ]
            );
        }
    }
}