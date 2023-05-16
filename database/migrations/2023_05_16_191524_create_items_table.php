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
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('image_id')->nullable();
            $table->unsignedInteger('section_id')->index('items_section_id_foreign');
            $table->timestamps();
            $table->string('activite')->nullable();
            $table->string('lvl')->nullable();
            $table->string('st')->nullable();
            $table->string('status')->nullable();
            $table->string('phrase')->nullable();
            $table->integer('user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
