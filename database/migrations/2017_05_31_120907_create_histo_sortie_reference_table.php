<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoSortieReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histo_sortie_reference', function (Blueprint $table) {
            // $table->uuid('pk_id');
            // $table->primary('pk_id');
            $table->increments('id');

            $table->integer('fk_id_reference')->unsigned();
            $table->foreign('fk_id_reference')->references('id')->on('lst_reference');

            $table->string('code_barre', 64);
           // $table->unsignedTinyInteger('is_deleted');
            $table->softDeletes();

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
        Schema::dropIfExists('histo_sortie_reference');
    }
}
