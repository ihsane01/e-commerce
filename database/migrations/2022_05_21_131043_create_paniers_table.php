<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paniers', function (Blueprint $table) {
            $table->id();
            $table->string('id_cmd')->default(Null);
            
            $table->string('nom_product');
            $table->string('image_product');
            $table->integer('prix_product');
            $table->integer('quantite_product');
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('users');
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
        Schema::dropIfExists('panier');
    }
};
