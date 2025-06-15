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
        Schema::create('faq_translations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('faq_id')->unsigned()->nullable();
            $table->foreign('faq_id')->references('id')->on('faqs')->onUpdate('cascade')->onDelete('cascade');
            $table->string('question',255)->nullable();
            $table->text('answer')->nullable();
            $table->string('locale')->index()->nullable();
            $table->unique(['faq_id', 'locale']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faq_translations');
    }
};
