<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->foreignId('carried_order_id')->nullable('orders');
            $table->foreignId('responsible_courier_id')->nullable()->nullable('couriers');
            $table->foreignId('pickup_point_id')->nullable('coordinates');
            $table->foreignId('drop_point_id')->nullable('coordinates');
            $table->foreignId('generated_route_id')->nullable()->nullable('routes');
            $table->foreignId('current_location_id')->nullable('coordinates');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
};
