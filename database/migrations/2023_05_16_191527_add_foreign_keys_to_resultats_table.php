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
        Schema::table('resultats', function (Blueprint $table) {
            $table->foreign(['enfant_id'])->references(['id'])->on('enfants')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['section_id'])->references(['id'])->on('sections')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['user_id'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('resultats', function (Blueprint $table) {
            $table->dropForeign('resultats_enfant_id_foreign');
            $table->dropForeign('resultats_section_id_foreign');
            $table->dropForeign('resultats_user_id_foreign');
        });
    }
};
