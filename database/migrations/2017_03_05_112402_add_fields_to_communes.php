<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToCommunes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('communes', function (Blueprint $table) {
              $table->string('code')->nullable()->after('nom');
              $table->longText('geojson')->nullable()->after('code');
              $table->integer('id_departement')->nullable()->change();
              $table->integer('id_region')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('communes', function (Blueprint $table) {
            $table->dropColumn('code');
            $table->dropColumn('geojson');
            $table->dropColumn('geojson_object');
        });
    }
}
