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
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('setting_id')->unsigned()->nullable();
            $table->foreign('setting_id')->references('id')->on('settings')->onUpdate('cascade')->onDelete('cascade');
            $table->string('system_name')->nullable();
            $table->string('about_us_title',255)->nullable();
            $table->string('home_first_title',255)->nullable();
            $table->string('home_second_title',255)->nullable();
            $table->text('about_us_description')->nullable();
            $table->text('footer_description')->nullable();
            $table->string('address',200)->nullable();
            $table->string('locale')->index()->nullable();
            $table->unique(['setting_id', 'locale']);
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_translations');
    }
};
