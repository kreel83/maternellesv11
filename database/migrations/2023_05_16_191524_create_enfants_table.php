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
        Schema::create('enfants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('prenom');
            $table->date('ddn');
            $table->string('photo')->nullable();
            $table->string('mail')->nullable();
            $table->string('comment')->nullable();
            $table->string('groupe');
            $table->string('token');
            $table->string('mdp', 8)->nullable();
            $table->date('datenotification')->nullable();
            $table->char('ecole', 15)->nullable();
            $table->timestamps();
            $table->string('genre', 1)->default('F');
            $table->unsignedInteger('user_id')->nullable()->index('enfants_user_id_foreign');
            $table->integer('annee_scolaire')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfants');
    }
};
