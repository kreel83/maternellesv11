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
        if(!Schema::hasTable('sections')){
            Schema::create('sections', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('color');
                $table->string('image_section')->default('default.jpg');
                $table->timestamps();
                $table->string('logo');
                $table->string('court');
                $table->string('texte');
                $table->string('icone')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
};
