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
        Schema::create('ecoles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('adresse1');
            $table->string('adresse2')->nullable();
            $table->string('codepostal');
            $table->string('ville');
            $table->string('telephone');
            $table->string('mail');
            $table->string('lastname');
            $table->string('firstname');
            $table->string('signature')->nullable();
            $table->timestamps();
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ecoles');
    }
};
