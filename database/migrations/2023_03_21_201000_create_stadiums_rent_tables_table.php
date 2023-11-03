<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStadiumsRentTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stadiums_rent_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('stadium_id');
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('price')->nullable();
            $table->enum('type',['trainer','strange'])->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('time_from')->nullable();
            $table->timestamp('time_to')->nullable();

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
        Schema::dropIfExists('stadiums_rent_tables');
    }
}
