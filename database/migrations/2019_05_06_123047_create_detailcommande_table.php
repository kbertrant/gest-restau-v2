<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailcommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailcommandes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('quantite');
            $table->unsignedInteger('prod_id');
            $table->unsignedInteger('com_id');
            $table->timestamps();
            $table->foreign('prod_id')->on('produits')->references('id')->onDelete('cascade');
            $table->foreign('com_id')->on('commandes')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailcommande');
    }
}
