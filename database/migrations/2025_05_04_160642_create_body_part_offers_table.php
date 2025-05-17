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
            $table->date('available_at');
            $table->text('description');
            $table->string('status');
            $table->date('last_updated_at');
            $table->foreignId('body_part_type_id')->constrained()->onDelete('cascade');
            //$table->timestamps();
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
