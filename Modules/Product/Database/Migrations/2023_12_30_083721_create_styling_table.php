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
        Schema::create('styling', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('base_image_id');
            $table->longText('description');
            $table->string('slug')->unique();
            $table->string('meta_title');
            $table->longText('meta_description');
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
        Schema::dropIfExists('styling');
    }
};