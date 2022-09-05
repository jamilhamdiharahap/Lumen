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
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->string('nama_pengirim');
            $table->string('nama_penerima');
            $table->string('desc');
            $table->integer('kg');
            $table->double('shipping_costs');
            $table->foreignUuid('user')->references('uuid')->on('users')->onDelete('cascade');
            $table->foreignUuid('product')->references('uuid')->on('products')->onDelete('cascade');
            $table->foreignUuid('city')->references('uuid')->on('city')->onDelete('cascade');
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
        Schema::dropIfExists('pengirimans');
    }
};
