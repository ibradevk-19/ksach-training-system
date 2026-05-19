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
        Schema::create('eligibility_rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('track_id')
                ->constrained('tracks')
                ->cascadeOnDelete();

            $table->string('field_name');

            $table->enum('source', [
                'applicant',
                'answer',
                'track'
            ])->default('answer');

            $table->enum('operator', [
                '=',
                '!=',
                '>',
                '>=',
                '<',
                '<=',
                'in',
                'not_in'
            ])->default('=');

            $table->json('expected_value')->nullable();

            $table->string('failure_message');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eligibility_rules');
    }
};
