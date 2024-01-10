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
        Schema::create('styling_to_datas', function (Blueprint $table) {
            $table->id();
            $table->integer('styling_id')->unsigned();
            $table->integer('product_id')->nullable(true);
            $table->integer('file_id')->nullable(true);;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('styling_to_datas');
    }
};
