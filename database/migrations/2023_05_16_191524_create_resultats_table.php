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
        if(!Schema::hasTable('resultats')){
            Schema::create('resultats', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('item_id')->index('resultats_item_id_foreign');
                $table->unsignedInteger('enfant_id')->index('resultats_enfant_id_foreign');
                $table->integer('notation')->index('resultats_notation_id_foreign');
                $table->timestamps();
                $table->unsignedInteger('section_id')->nullable()->index('resultats_section_id_foreign');
                $table->unsignedInteger('user_id')->nullable()->index('resultats_user_id_foreign');
                $table->string('groupe');
                $table->unsignedInteger('autonome')->nullable()->default(1);
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
        Schema::dropIfExists('resultats');
    }
};
