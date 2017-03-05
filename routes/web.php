<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/insert","InsertController@insert");

Route::get("/","AccueilController@accueil");

Route::get("/candidat/{id}","CandidatController@showCandidat");

Route::get("/candidats","CandidatController@showAllCandidats");

Route::get("/parrains","ParrainController@showAllParrains");

Route::get("/search","SearchController@index");

Route::get("/geo/add_communes","GeoController@add_communes");
Route::get("/geo/add_departements","GeoController@add_departements");
Route::get("/geo/add_regions","GeoController@add_regions");
