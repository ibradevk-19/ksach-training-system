<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('national_id')->unique();

            $table->string('phone_1')->unique();
            $table->string('phone_2')->nullable();

            $table->enum('gender', ['male', 'female']);

            $table->date('birth_date')->nullable();

            $table->foreignId('governorate_id')
                ->nullable()
                ->constrained('governorates')
                ->nullOnDelete();

            $table->enum('displacement_status', ['resident', 'displaced'])->nullable();

            $table->foreignId('residence_type_id')
                ->nullable()
                ->constrained('residence_types')
                ->nullOnDelete();

            $table->text('current_address')->nullable();

            $table->unsignedInteger('family_members_count')->nullable();

            $table->enum('breadwinner_status', [
                'husband',
                'single',
                'widow',
                'divorced',
                'other'
            ])->nullable();

            $table->enum('employment_status', ['employed', 'unemployed'])->nullable();

            $table->foreignId('income_type_id')
                ->nullable()
                ->constrained('income_types')
                ->nullOnDelete();

            $table->enum('education_level', [
                'none',
                'preparatory',
                'secondary',
                'diploma',
                'bachelor',
                'master_or_above'
            ])->nullable();

            $table->string('specialization')->nullable();

            $table->enum('health_status', ['healthy', 'disabled'])->nullable();

            $table->string('identity_image')->nullable();
            $table->string('medical_report')->nullable();
            $table->string('education_certificate')->nullable();

            $table->boolean('is_active')->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('full_name');
            $table->index('gender');
            $table->index('health_status');
            $table->index('employment_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
