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
            $table->unsignedBigInteger('country_id');
            $table->string('nick_name')->unique();
            $table->integer('age')->index();
            $table->string('state')->index();
            $table->string('password');
            $table->enum('gender', [1, 2])->index();
            $table->boolean('blocked')->default(0);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
