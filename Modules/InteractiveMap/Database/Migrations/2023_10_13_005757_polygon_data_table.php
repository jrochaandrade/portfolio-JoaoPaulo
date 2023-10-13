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
        Schema::create('polygon_data', function(Blueprint $table){
            $table->bigIncrements('id_polygon');
            $table->string('id_register');
            $table->integer('unique_id');
            $table->string('name');
            $table->string('cpf')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('area');
            $table->string('infraction_notice');
            $table->string('decree');
            $table->string('embargo');
            $table->string('ocurrence');
            $table->string('law');
            $table->string('type_infraction');
            $table->date('date');
            $table->string('team');
            $table->string('centroid');
            $table->string('operation');
            $table->string('geo_manager');
            $table->integer('id_user_created_at');
            $table->integer('id_user_last_updated_at')->nullable();
            $table->integer('id_user_deleted_at')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polygon_data');
    }
};
