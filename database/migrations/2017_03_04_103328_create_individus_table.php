<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndividusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('individus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('civilite',5);
            $table->string('prenom');
            $table->string('nom');

            $table->integer('id_candidat');
        
            $table->date('parrainage_publication_date');
            $table->integer('id_commune');
            $table->integer('id_circonscription');
            $table->integer('id_departement');
            $table->integer('id_region');
            






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
        Schema::dropIfExists('individus');
    }
}
