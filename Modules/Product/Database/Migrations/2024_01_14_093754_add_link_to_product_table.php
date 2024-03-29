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
        Schema::table('products', function (Blueprint $table) {
            $table->string('link_shopee')->nullable(true)->before('virtual');
            $table->string('link_lazada')->nullable(true)->before('link_shopee');
            $table->string('link_tiki')->nullable(true)->before('link_lazada');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('link_tiki');
            $table->dropColumn('link_lazada');
            $table->dropColumn('link_shopee');
        });
    }
};
