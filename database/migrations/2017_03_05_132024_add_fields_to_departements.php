<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToDepartements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('departements', function (Blueprint $table) {
          $table->longText('geojson')->nullable()->after('code');
          $table->integer('id_region')->nullable()->change();
          $table->string('code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('departements', function (Blueprint $table) {
          $table->dropColumn('geojson');
        });
    }
}
