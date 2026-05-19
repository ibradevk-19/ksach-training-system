<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // System Settings

        Schema::create('settings', function (Blueprint $table) {

            $table->id();

            $table->string('key')->unique();

            $table->longText('value')->nullable();

            $table->timestamps();
        });

        // Governorates

        Schema::create('governorates', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->boolean('status')->default(true);

            $table->timestamps();
        });

        // Residence Types

        Schema::create('residence_types', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->boolean('status')->default(true);

            $table->timestamps();
        });

        // Income Types

        Schema::create('income_types', function (Blueprint $table) {

            $table->id();

            $table->string('name');

            $table->boolean('status')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('income_types');
        Schema::dropIfExists('residence_types');
        Schema::dropIfExists('governorates');
        Schema::dropIfExists('settings');
    }
};