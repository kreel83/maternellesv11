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
        Schema::create('modifitems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('item_id')->index('modifitems_item_id_foreign');
            $table->unsignedInteger('professeur_id')->index('modifitems_professeur_id_foreign');
            $table->string('st')->nullable();
            $table->string('name')->nullable();
            $table->string('activite')->nullable();
            $table->string('lvl')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
            $table->unsignedInteger('section_id')->nullable()->index('modifitems_section_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modifitems');
    }
};
