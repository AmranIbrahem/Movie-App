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
        Schema::create('series_episodes', function (Blueprint $table) {
            $table->id();
            $table->string("number_episodes")->nullable();
            $table->string("video")->nullable();
            $table->string("photo")->nullable();
            $table->foreignId('id_series')
                ->constrained('series')
                ->cascadeOnDelete();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series_episodes');
    }
};
