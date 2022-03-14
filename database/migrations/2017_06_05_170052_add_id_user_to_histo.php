<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdUserToHisto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('histo_ajout_reference', function(Blueprint $table)
        {
            $table->integer('fk_id_user')->unsigned()->after('id');
            $table->foreign('fk_id_user')->references('id')->on('users');
        });

        Schema::table('histo_sortie_reference', function(Blueprint $table)
        {
            $table->integer('fk_id_user')->unsigned()->after('id');
            $table->foreign('fk_id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('histo_ajout_reference', 'fk_id_user'))
        {
            Schema::table('histo_ajout_reference', function(Blueprint $table)
            {
                $table->dropColumn('fk_id_user');
            });
        }

        if (Schema::hasColumn('histo_sortie_reference', 'fk_id_user'))
        {
            Schema::table('histo_sortie_reference', function(Blueprint $table)
            {
                $table->dropColumn('fk_id_user');
            });
        }
    }
}
