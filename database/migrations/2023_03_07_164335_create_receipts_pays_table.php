<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsPaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts_pays', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('from');
            $table->integer('to');
            $table->string('type_of_to');
            $table->decimal('amount');
            $table->date('date_receipt');
            $table->longText('statement')->nullable();
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
        Schema::dropIfExists('receipts_pays');
    }
}
