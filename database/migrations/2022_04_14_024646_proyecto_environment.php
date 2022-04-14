<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProyectoEnvironment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_proyecto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
        Schema::create('estatus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('slug')->nullable();
            $table->unsignedInteger('estatus_id');
            $table->foreign('estatus_id')->references('id')->on('estatus');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedInteger('proyecto_id');
            $table->foreign('proyecto_id')->references('id')->on('tipo_proyecto');
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
        Schema::dropIfExists('proyectos');
        Schema::dropIfExists('estatus');
        Schema::dropIfExists('tipo_proyecto');
    }
}
