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
        if(!Schema::hasTable('myperiodes')){
            Schema::create('myperiodes', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('user_id');
                $table->integer('annee');
                $table->integer('periode');
                $table->date('date_start');
                $table->date('date_end');
                $table->dateTime('updated_at');
                $table->dateTime('created_at');
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
        Schema::dropIfExists('myperiodes');
    }
};
