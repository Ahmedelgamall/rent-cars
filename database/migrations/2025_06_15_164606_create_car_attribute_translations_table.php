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
        Schema::create('car_attribute_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('car_attribute_id')->unsigned()->nullable();
            $table->foreign('car_attribute_id')->references('id')->on('car_attributes')->onUpdate('cascade')->onDelete('cascade');
            $table->string('key',255)->nullable();
            $table->string('value',255)->nullable();
            $table->string('locale')->index()->nullable();
            $table->unique(['car_attribute_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_attribute_translations');
    }
};
