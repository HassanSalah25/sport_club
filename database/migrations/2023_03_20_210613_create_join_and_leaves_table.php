<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoinAndLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('join_and_leaves', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->timestamp('date_of_join')->nullable();
            $table->timestamp('date_of_leave')->nullable();
            $table->longText('reason_of_leave')->nullable();
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
        Schema::dropIfExists('join_and_leaves');
    }
}
