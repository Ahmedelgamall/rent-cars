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
        Schema::create('why_choose_us_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('why_choose_us_id')->unsigned()->nullable();
            $table->foreign('why_choose_us_id')->references('id')->on('why_choose_us')->onUpdate('cascade')->onDelete('cascade');
            $table->string('title',255)->nullable();
            $table->text('text')->nullable();
            $table->string('locale')->index()->nullable();
            $table->unique(['why_choose_us_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('why_choose_us_translations');
    }
};
