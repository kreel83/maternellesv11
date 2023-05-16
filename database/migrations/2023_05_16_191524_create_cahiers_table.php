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
        Schema::create('cahiers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable()->index('cahiers_user_id_foreign');
            $table->unsignedInteger('enfant_id')->nullable()->index('cahiers_enfant_id_foreign');
            $table->longText('texte');
            $table->integer('section_id')->nullable();
            $table->timestamps();
            $table->boolean('definitif');
            $table->date('send_at')->nullable();
            $table->date('ar_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cahiers');
    }
};
