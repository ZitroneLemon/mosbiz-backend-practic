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
        Schema::create('header_info', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->default('+7 (499) 444-16-15');
            $table->string('email')->default('dpir-press@mos.ru');
            $table->string('feedback_link')->default('#');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('header_info');
    }
};
