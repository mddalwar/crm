<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvoiceProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invproducts', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice');
            $table->integer('product');
            $table->string('quantity');
            $table->string('price');
            $table->string('profit');
            $table->string('total');
            $table->string('status');
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
        Schema::dropIfExists('invproducts');
    }
}
