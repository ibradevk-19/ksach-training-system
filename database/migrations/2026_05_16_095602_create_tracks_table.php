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
        Schema::create('tracks', function (Blueprint $table) {
             $table->id();

            $table->foreignId('track_type_id')
                ->nullable()
                ->constrained('track_types')
                ->nullOnDelete();

            $table->foreignId('track_category_id')
                ->nullable()
                ->constrained('track_categories')
                ->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->string('thumbnail')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->date('registration_start')->nullable();
            $table->date('registration_end')->nullable();

            $table->unsignedInteger('seats')->default(0);

            $table->enum('gender', ['male', 'female', 'both'])->default('both');

            $table->unsignedTinyInteger('min_age')->nullable();
            $table->unsignedTinyInteger('max_age')->nullable();

            $table->boolean('allow_waiting_list')->default(true);
            $table->boolean('requires_review')->default(true);

            $table->enum('status', [
                'draft',
                'published',
                'closed',
                'archived'
            ])->default('draft');

            $table->boolean('is_featured')->default(false);

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
