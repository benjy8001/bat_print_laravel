<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lst_reference', function (Blueprint $table) {
            // $table->uuid('pk_id');
            // $table->primary('pk_id');
            $table->increments('id');

            $table->string('code_barre', 64)->unique();
            $table->string('description', 64);
            $table->integer('nb_stock');
            //$table->unsignedTinyInteger('is_deleted');
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
        Schema::dropIfExists('lst_reference');
    }
}
