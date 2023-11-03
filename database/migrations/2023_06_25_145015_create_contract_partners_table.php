<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractPartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_partners', function (Blueprint $table) {
            $table->id();
            $table->integer('from_company');
            $table->date('from');
            $table->date('to');
            $table->integer('percentage');
            $table->string('type_of_contract');
            $table->string('file_name');
            $table->string('file');
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
        Schema::dropIfExists('contract_partners');
    }
}
