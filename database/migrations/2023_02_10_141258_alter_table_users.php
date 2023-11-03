<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users',function ( Blueprint $table){
           $table->integer('phone')->nullable();
           $table->integer('phone2')->nullable();
           $table->string('address')->nullable();
           $table->enum('is_trainer',[0,1])->default(0);
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
