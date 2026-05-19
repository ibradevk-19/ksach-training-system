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
        Schema::create('form_fields', function (Blueprint $table) {
                $table->id();

                $table->foreignId('form_id')
                    ->constrained('forms')
                    ->cascadeOnDelete();

                $table->foreignId('form_section_id')
                    ->nullable()
                    ->constrained('form_sections')
                    ->nullOnDelete();

                $table->string('label');
                $table->string('name');

                $table->enum('type', [
                    'text',
                    'textarea',
                    'number',
                    'date',
                    'select',
                    'radio',
                    'checkbox',
                    'file'
                ]);

                $table->string('placeholder')->nullable();

                $table->json('options')->nullable();

                $table->boolean('is_required')->default(false);

                $table->string('validation_rules')->nullable();

                $table->unsignedTinyInteger('width')->default(12);

                $table->unsignedInteger('sort_order')->default(0);

                $table->boolean('status')->default(true);

                $table->timestamps();

                $table->unique(['form_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_fields');
    }
};
