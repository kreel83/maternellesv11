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
        if(!Schema::hasTable('professeurs')){
            Schema::create('professeurs', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->index('professeurs_user_id_foreign');
                $table->string('prenom');
                $table->string('repertoire', 8);
                $table->tinyInteger('actif')->nullable();
                $table->boolean('classe');
                $table->date('datePayment')->nullable();
                $table->unsignedInteger('ecole_id')->nullable()->index('professeurs_ecole_id_foreign');
                $table->timestamps();
                $table->boolean('comment')->default(false);
                $table->date('expire_le')->nullable();
                $table->string('reject')->nullable();
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
        Schema::dropIfExists('professeurs');
    }
};
