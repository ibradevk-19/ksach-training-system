<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->enum('marital_status', [
                'husband',
                'single',
                'widow',
                'divorced',
                'other',
            ])->nullable()->after('gender');
        });

        $options = json_encode(['الزوج', 'أعزب', 'أرملة', 'مطلقة', 'أخرى'], JSON_UNESCAPED_UNICODE);

        DB::table('form_sections')
            ->where('sort_order', 1)
            ->orderBy('id')
            ->get(['id', 'form_id'])
            ->each(function ($section) use ($options) {
                $exists = DB::table('form_fields')
                    ->where('form_id', $section->form_id)
                    ->where('name', 'marital_status')
                    ->exists();

                if (! $exists) {
                    DB::table('form_fields')->insert([
                        'form_id' => $section->form_id,
                        'form_section_id' => $section->id,
                        'label' => 'الحالة الاجتماعية',
                        'name' => 'marital_status',
                        'type' => 'select',
                        'options' => $options,
                        'is_required' => false,
                        'width' => 6,
                        'sort_order' => 0,
                        'status' => true,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            });
    }

    public function down(): void
    {
        DB::table('form_fields')->where('name', 'marital_status')->delete();

        Schema::table('applicants', function (Blueprint $table) {
            $table->dropColumn('marital_status');
        });
    }
};
