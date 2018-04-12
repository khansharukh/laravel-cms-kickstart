<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('color');
            $table->string('size');
            $table->string('quantity');
            $table->decimal('price', 11, 2);
            $table->string('qr_code');
            $table->integer('unit_id');
            $table->integer('grade_id');
            $table->integer('packaging_id');
            $table->integer('category_id');
            $table->enum('status', ['0', '1'])->default('0')	;
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
}
