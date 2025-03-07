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
        Schema::create('bricks', function (Blueprint $table) {
            $table->id();
            $table->string('name_uz');
            $table->string('name_ru');
            $table->string('name_en');
            $table->decimal('price', 15, 2);
            $table->text('description_uz');
            $table->text('description_ru');
            $table->text('description_en');
            $table->integer('residual');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bricks');
    }
};
