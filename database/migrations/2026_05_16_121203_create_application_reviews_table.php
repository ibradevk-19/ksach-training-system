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
        Schema::create('application_reviews', function (Blueprint $table) {
             $table->id();

            $table->foreignId('application_id')
                ->constrained('applications')
                ->cascadeOnDelete();

            $table->foreignId('reviewed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('eligibility_status', [
                'eligible',
                'partially_eligible',
                'not_eligible'
            ])->default('eligible');

            $table->unsignedInteger('auto_score')->default(0);
            $table->unsignedInteger('manual_score')->default(0);
            $table->unsignedInteger('final_score')->default(0);

            $table->json('passed_rules')->nullable();
            $table->json('failed_rules')->nullable();

            $table->text('notes')->nullable();

            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_reviews');
    }
};
