<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->enum('personal_image',[0,1])->default(0);
            $table->enum('father_national_image',[0,1])->default(0);
            $table->enum('birth_certificate',[0,1])->default(0);
            $table->enum('medical',[0,1])->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('palyers', function (Blueprint $table) {
            //
        });
    }
}
