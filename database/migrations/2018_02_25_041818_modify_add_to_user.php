<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAddToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('fb_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('ins_link')->nullable()->comment('Instagram link');
            $table->string('whatsapp')->nullable();
            $table->text('address')->nullable();
            $table->text('about')->nullable();
            $table->string('title')->nullable()->comment('Job title');
            $table->string('loca')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fb_link');
            $table->dropColumn('twitter_link');
            $table->dropColumn('ins_link');
            $table->dropColumn('whatsapp');
            $table->dropColumn('address');
            $table->dropColumn('about');
            $table->dropColumn('title');
            $table->dropColumn('location');
        });
    }
}
