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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('driver_id');
            $table->date('order_date');
            $table->decimal('total_amount', 15, 2);
            $table->string('order_status')->default('new');
            $table->string('shipping_address');
            $table->decimal('latitude', 10, 7)->nullable()->after('shipping_address');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
