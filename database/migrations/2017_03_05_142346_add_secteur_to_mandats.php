<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSecteurToMandats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mandats', function (Blueprint $table) {
          $table->string('secteur')->nullable()->after('nom');
          $table->index(['secteur']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mandats', function (Blueprint $table) {
          $table->dropColumn('secteur');
            //
        });
    }
}
