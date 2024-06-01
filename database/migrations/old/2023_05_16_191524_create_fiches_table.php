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
        if(!Schema::hasTable('fiches')){
            Schema::create('fiches', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('item_id')->nullable();
                $table->integer('order')->nullable();
                $table->boolean('perso')->nullable()->default(true);
                $table->integer('user_id')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->dateTime('created_at')->nullable();
                $table->integer('section_id')->nullable();
                $table->string('parent_type', 50)->nullable();
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
        Schema::dropIfExists('fiches');
    }
};
