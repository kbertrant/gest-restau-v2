<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockHistoricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_historics', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('site_id');
            $table->unsignedInteger('prod_id');
            $table->string('type_mouvement');
            $table->integer('qte_deplacee');
            $table->timestamps();

            $table->foreign('prod_id')->references('id')->on('produits');
            $table->foreign('site_id')->references('id')->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_historics');
    }
}
