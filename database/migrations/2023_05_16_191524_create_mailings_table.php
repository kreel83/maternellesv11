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
        Schema::create('mailings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('destinataires');
            $table->string('validations')->nullable();
            $table->boolean('ar');
            $table->string('token');
            $table->string('sujet');
            $table->string('body');
            $table->string('medias')->nullable();
            $table->unsignedInteger('user_id')->index('mailings_user_id_foreign');
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
        Schema::dropIfExists('mailings');
    }
};
