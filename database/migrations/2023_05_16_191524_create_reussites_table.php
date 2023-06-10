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
        if(!Schema::hasTable('reussites')){
            Schema::create('reussites', function (Blueprint $table) {
                $table->integer('id', true);
                $table->integer('enfant_id')->nullable();
                $table->integer('user_id')->nullable();
                $table->longText('texte_integral')->nullable();
                $table->longText('commentaire_general')->nullable();
                $table->boolean('definitif')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->dateTime('created_at')->nullable();
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
        Schema::dropIfExists('reussites');
    }
};
