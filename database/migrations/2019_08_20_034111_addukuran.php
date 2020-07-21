<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addukuran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('keranjangs', function($table) {
            $table->string('ukuran');
        });
        Schema::table('orders', function($table) {
            $table->string('ukuran');
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
        Schema::table('keranjangs', function($table) {
            $table->dropColumn('ukuran');
        });
        Schema::table('orders', function($table) {
            $table->dropColumn('ukuran');
        });
    }
}
