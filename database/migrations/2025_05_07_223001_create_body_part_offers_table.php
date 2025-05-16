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
        Schema::create('body_part_offers', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->date('received_date');
            $table->text('description');
            $table->string('state')->default('not_accepted');
            $table->foreignId('type_id')->nullable('body_part_types');
            $table->foreignId('auction_id')->nullable()->nullable();
            $table->foreignId('order_id')->nullable()->nullable();
            $table->foreignId('provider_id')->nullable('suppliers');
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
        Schema::dropIfExists('body_part_offers');
    }
};
