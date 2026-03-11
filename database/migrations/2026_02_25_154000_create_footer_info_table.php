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
        Schema::create('footer_info', function (Blueprint $table) {
            $table->id();
            $table->string('email')->default('dpir-press@mos.ru');
            $table->string('address')->default('125009, г. Москва, Романов переулок, д. 4 стр. 2');
            $table->string('privacy_policy_link')->default('#');
            $table->string('newsletter_link')->default('#');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_info');
    }
};
