<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid');
            $table->string('title');
            $table->string('coupon');
            $table->string('value');
            $table->string('unit');
            $table->string('banner');
            $table->integer('min_amt');
            $table->date('start');
            $table->date('end');
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
        Schema::dropIfExists('coupons');
    }
}
