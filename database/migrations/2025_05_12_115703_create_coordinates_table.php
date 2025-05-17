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
        // 	Store path of a single Route (existing)
        Schema::create('coordinates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('route_id')->nullable()->constrained()->onDelete('cascade');
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });

        // All known OSM nodes (for A*)
        Schema::create('road_nodes', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary(); // Use osmid as primary key
            $table->double('latitude');
            $table->double('longitude');
            $table->timestamps();
        });

        // Edge weights between those nodes (for A*)
        Schema::create('road_edges', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_id');
            $table->unsignedBigInteger('to_id');
            $table->double('weight'); // road length
            $table->timestamps();

            $table->foreign('from_id')->references('id')->on('road_nodes')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('road_nodes')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('road_edges');
        Schema::dropIfExists('road_nodes');
        Schema::dropIfExists('coordinates');
    }
};
