<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('population_communities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('governorate_id')
                ->constrained('governorates')
                ->cascadeOnDelete();
            $table->string('name');
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->unique(['governorate_id', 'name']);
        });

        Schema::table('applicants', function (Blueprint $table) {
            $table->foreignId('population_community_id')
                ->nullable()
                ->after('governorate_id')
                ->constrained('population_communities')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('applicants', function (Blueprint $table) {
            $table->dropConstrainedForeignId('population_community_id');
        });

        Schema::dropIfExists('population_communities');
    }
};
