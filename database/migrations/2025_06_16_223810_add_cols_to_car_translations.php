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
        Schema::table('car_translations', function (Blueprint $table) {
            $table->string('slug',255)->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('car_translations', function (Blueprint $table) {
            $table-dropColumn('slug');
            $table-dropColumn('meta_keywords');
            $table-dropColumn('meta_description');
        });
    }
};
