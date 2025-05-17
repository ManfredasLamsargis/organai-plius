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
            $table->foreignId('pickup_point_coordinate_id')->constrained('coordinates');
            $table->foreignId('drop_point_coordinate_id')->constrained('coordinates');
            $table->foreignId('current_location_coordinate_id')->nullable()->constrained('coordinates');
            // MANFREDAS_TODO: create add a responsible courier foreign key
            $table->foreignId('generated_route_id')->nullable()->constrained('routes');
            $table->enum('state', [
                'unaccepted',
                'reserved_for_generation',
                'not_started',
                'in_progress',
                'cancelled',
                'delivered_unclaimed',
                'delivered_claimed'
            ])->default('unaccepted');
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
