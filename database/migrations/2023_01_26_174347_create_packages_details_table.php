<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id');

            $table->bigInteger('price_list_id');
            $table->integer('price');
            $table->integer('number_of_training');
            $table->integer('total_price_of_training');

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
        Schema::dropIfExists('packages_details');
    }
}
