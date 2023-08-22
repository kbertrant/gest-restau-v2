<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dev_num');
            $table->float('dev_fees');
            $table->string('dev_stat');
            $table->string('dev_address');
            $table->float('packaging');
            $table->float('dev_ttval');
            $table->unsignedInteger('cmd_id');
            $table->unsignedInteger('site_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('idcl')->nullable();
            $table->unsignedInteger('pay_id')->nullable();
            $table->timestamps();

            $table->foreign('cmd_id')->references('id')->on('commandes');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('idcl')->references('id')->on('clientes');
            $table->foreign('pay_id')->references('id')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deliveries');
    }
}
