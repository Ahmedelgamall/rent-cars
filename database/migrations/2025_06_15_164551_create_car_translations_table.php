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
        Schema::create('car_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_id')->unsigned()->nullable();
            $table->foreign('car_id')->references('id')->on('cars')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title',255)->nullable();
            $table->string('model',255)->nullable();
            $table->text('description')->nullable();
            $table->string('locale')->index()->nullable();
            $table->unique(['car_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_translations');
    }
};
