<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pay_num');
            $table->float('pay_amount');
            $table->string('pay_mode');
            $table->float('pay_reste');
            $table->string('pay_stat');
            $table->unsignedInteger('cmd_id');
            $table->unsignedInteger('site_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('idcl')->nullable();
            $table->timestamps();

            $table->foreign('cmd_id')->references('id')->on('commandes');
            $table->foreign('site_id')->references('id')->on('sites');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('idcl')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
