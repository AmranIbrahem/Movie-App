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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('summary');
            $table->string('release_date');
            $table->string('video')->nullable();
            $table->string('director');
            $table->string('main_photo')->nullable();
            $table->foreignId('category_id')
                ->constrained('category')
                ->cascadeOnDelete();
            $table->timestamps();

//            $table->foreign('category')->references('id')->on('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
