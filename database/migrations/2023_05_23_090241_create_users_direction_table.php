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
        Schema::create('users_direction', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique('users_email_unique');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('confirmation_token')->nullable();
            $table->string('prenom')->nullable();
            $table->string('classe', 10)->nullable();
            $table->string('sectionColors')->nullable();
            $table->unsignedInteger('ecole_id')->nullable()->index('users_ecole_id_foreign');
            $table->string('nom_ecole', 150)->nullable();
            $table->string('nom_directeur', 150)->nullable();
            $table->string('adresse_ecole', 250)->nullable();
            $table->string('academie', 50)->nullable();
            $table->string('repertoire', 8)->nullable();
            $table->string('signature')->default('signature.jpg');
            $table->tinyInteger('directeur')->default(0);
            $table->string('photo')->nullable();
            $table->string('reject')->nullable();
            $table->tinyInteger('comment')->nullable();
            $table->date('expire_le')->nullable();
            $table->date('datePayment')->nullable();
            $table->tinyInteger('actif')->nullable();
            $table->string('periodes')->nullable();
            $table->string('mailcontact')->nullable();
            $table->string('sections', 60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_direction');
    }
};
