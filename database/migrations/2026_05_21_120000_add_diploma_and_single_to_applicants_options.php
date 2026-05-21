<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE applicants MODIFY breadwinner_status ENUM('husband','single','widow','divorced','other') NULL");
            DB::statement("ALTER TABLE applicants MODIFY education_level ENUM('none','preparatory','secondary','diploma','bachelor','master_or_above') NULL");
        }

        DB::table('form_fields')
            ->where('name', 'breadwinner_status')
            ->update([
                'options' => json_encode(['الزوج', 'أعزب', 'أرملة', 'مطلقة', 'أخرى'], JSON_UNESCAPED_UNICODE),
            ]);

        DB::table('form_fields')
            ->where('name', 'education_level')
            ->update([
                'options' => json_encode(['بدون', 'شهادة ثالث إعدادي', 'ثانوية عامة', 'دبلوم', 'بكالوريوس', 'ماجستير فأعلى'], JSON_UNESCAPED_UNICODE),
            ]);
    }

    public function down(): void
    {
        DB::table('applicants')->where('breadwinner_status', 'single')->update(['breadwinner_status' => 'other']);
        DB::table('applicants')->where('education_level', 'diploma')->update(['education_level' => 'bachelor']);

        if (in_array(DB::getDriverName(), ['mysql', 'mariadb'], true)) {
            DB::statement("ALTER TABLE applicants MODIFY breadwinner_status ENUM('husband','widow','divorced','other') NULL");
            DB::statement("ALTER TABLE applicants MODIFY education_level ENUM('none','preparatory','secondary','bachelor','master_or_above') NULL");
        }

        DB::table('form_fields')
            ->where('name', 'breadwinner_status')
            ->update([
                'options' => json_encode(['الزوج', 'أرملة', 'مطلقة', 'أخرى'], JSON_UNESCAPED_UNICODE),
            ]);

        DB::table('form_fields')
            ->where('name', 'education_level')
            ->update([
                'options' => json_encode(['بدون', 'شهادة ثالث إعدادي', 'ثانوية عامة', 'بكالوريوس', 'ماجستير فأعلى'], JSON_UNESCAPED_UNICODE),
            ]);
    }
};
