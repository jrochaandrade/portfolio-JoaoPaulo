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
        Schema::create('polygon_coordinates', function (Blueprint $table){
            $table->bigIncrements('coordinate_id');
            $table->integer('unique_id_coord');
            $table->unsignedBigInteger('polygon_data_id_fk');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('type_polygon');
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->foreign('polygon_data_id_fk')->references('id_polygon')->on('polygon_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polygon_coordinates');
    }
};
