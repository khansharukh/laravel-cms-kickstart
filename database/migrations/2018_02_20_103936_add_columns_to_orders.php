<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('discount');
            $table->enum('del_type', ['0', '1'])->default('0');
            $table->enum('payment_status', ['0', '1'])->default('0');
            $table->text('s_ins');
            $table->enum('tracking_status', ['0', '1', '2', '3'])->default('0');
            $table->dropColumn('category_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
