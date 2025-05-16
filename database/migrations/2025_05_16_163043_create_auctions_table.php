<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->double('minimal_bid');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('finish_time')->nullable();
            $table->string('state')->default('not_reserved');

            $table->unsignedBigInteger('body_part_offer_id');
            $table->foreign('body_part_offer_id')->references('id')->on('body_part_offers');
//$table->foreign('body_part_offer_id')->references('id')->on('body_part_offers');
            $table->unsignedBigInteger('winner_id')->nullable(); // no FK
//$table->foreign('winner_id')->references('id')->on('clients');
            $table->unsignedInteger('participant_count')->default(0);

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
        Schema::dropIfExists('auctions');
    }
};