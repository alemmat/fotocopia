<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentroDeCopiadoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_de_copiado_user', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('centro_de_copiado_id')->unsigned()->nullable();
            $table->foreign('centro_de_copiado_id')->references('id')->on('centro_de_copiados');
            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centro_de_copiado_user');
    }
}
