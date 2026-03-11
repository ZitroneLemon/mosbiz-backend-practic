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
        Schema::create('hero_blocks', function (Blueprint $table) {
            $table->id();
            $table->string('main_title')->default('ДЕПАРТАМЕНТ ПРЕДПРИНИМАТЕЛЬСТВА И ИННОВАЦИОННОГО РАЗВИТИЯ ГОРОДА МОСКВЫ');
            $table->string('background_image')->nullable();
            $table->string('stat_1_value')->default('105 млрд ₽');
            $table->string('stat_1_label')->default('Направлено на поддержку');
            $table->string('stat_2_value')->default('1 млн');
            $table->string('stat_2_label')->default('Оказанных услуг');
            $table->string('stat_3_value')->default('250 000');
            $table->string('stat_3_label')->default('Поддержанных предпринимателей');
            $table->string('bottom_title')->default('ПРОГРАММЫ И ИНСТРУМЕНТЫ ДЛЯ РАЗВИТИЯ БИЗНЕСА');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_blocks');
    }
};
