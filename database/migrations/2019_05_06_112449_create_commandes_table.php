<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero');
            $table->integer('ttval');
            $table->string('cmd_stat')->default('Pending');
            $table->integer('remise')->nullable();
            $table->string('value_remise')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('site_id');
            $table->unsignedInteger('cl_id')->nullable();
            $table->unsignedInteger('table_id')->nullable();
            $table->string('cmd_delivery')->default('N');
            $table->timestamps();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->foreign('site_id')->on('sites')->references('id')->onDelete('cascade');
            $table->foreign('cl_id')->on('clientes')->references('id')->onDelete('cascade');
            $table->foreign('table_id')->on('table_positions')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commandes');
    }
}
