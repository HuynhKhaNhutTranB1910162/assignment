<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('shipping_address');
            $table->string('user_id');
            $table->string('shipper_id');
            $table->string('shipper_status')->default('pending');
            $table->string('user_name');
            $table->string('phone');
            $table->string('tracking_number');
            $table->string('payment')->nullable();
            $table->string('payment_status')->nullable();
            $table->integer('total');
            $table->string('status')->default('pending');
            $table->string('notes')->nullable();
            $table->string('reviews')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
