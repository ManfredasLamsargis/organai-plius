<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->double('minimum_bid');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('status');
            $table->integer('participant_count')->default(0);
        });

        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->double('amount');
            $table->unsignedBigInteger('auction_id');

            $table->foreign('auction_id')
                  ->references('id')
                  ->on('auctions')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bids');
        Schema::dropIfExists('auctions');
    }
};
