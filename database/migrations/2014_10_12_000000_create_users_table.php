<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('personal_image',[0,1])->default(0)->nullable();
            $table->enum('national_image',[0,1])->default(0)->nullable();
            $table->enum('birth_certificate',[0,1])->default(0)->nullable();
            $table->enum('degree_certificate',[0,1])->default(0)->nullable();
            $table->enum('army_certificate',[0,1])->default(0)->nullable();
            $table->enum('feish',[0,1])->default(0)->nullable();
            $table->string('password_unhash')->nullable();
            $table->string('department')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
