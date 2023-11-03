<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('study');
            $table->longText('note')->nullable();
            $table->dateTime('birth_day');
            $table->dateTime('join_day');
            $table->string('father_name');
            $table->integer('father_phone');
            $table->integer('anther_phone')->nullable();
            $table->string('father_job');
            $table->string('father_email')->unique();
            $table->integer('branch_id');
            $table->integer('sport_id');
            $table->integer('level_id')->nullable();
            $table->integer('package_id')->nullable();
            $table->string('anther_sport')->nullable();
            $table->string('join_by')->nullable();
            $table->string('goal_of_sport')->nullable();



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
        Schema::dropIfExists('players');
    }
}
