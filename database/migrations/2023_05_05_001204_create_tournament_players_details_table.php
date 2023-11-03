<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTournamentPlayersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_players_details', function (Blueprint $table) {
            $table->id();
            $table->integer('tournament_id');
            $table->integer('player_id');
            $table->integer('files_data')->default(0)->nullable();
            $table->integer('paid')->default(0)->nullable();
            $table->integer('subscribe')->default(0)->nullable();
            $table->string('place')->nullable();
            $table->longText('notes')->nullable();



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
        Schema::dropIfExists('tournament_players_details');
    }
}
