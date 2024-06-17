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
        Schema::create('actor_series', function (Blueprint $table) {
            $table->id();
            $table->string('id_actor');
            $table->string('id_series');
            $table->timestamps();

//            $table->foreign('id_actor')->references('id')->on('actor');
//            $table->foreign('id_series')->references('id')->on('series');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actor_series');
    }
};
