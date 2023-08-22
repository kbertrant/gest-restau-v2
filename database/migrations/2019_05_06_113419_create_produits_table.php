<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('prod_name');
            $table->string('prod_type');
            $table->string('description');
            $table->integer('prod_qte');
            $table->integer('stock_min');
            $table->string('prix_unit');
            $table->unsignedInteger('cat_id');
            $table->timestamps();
            $table->foreign('cat_id')->on('categories')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
