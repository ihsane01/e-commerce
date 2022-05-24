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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('image');
            $table->string('description');
            $table->integer('prix');
            $table->integer('quantite');
            $table->unsignedBigInteger('id_admin')->default(1);
            $table->foreign('id_admin')->references('id')->on('users');
            $table->unsignedBigInteger('id_cat');
            $table->foreign('id_cat')->references('id')->on('categories');
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
        Schema::dropIfExists('products');
    }
};