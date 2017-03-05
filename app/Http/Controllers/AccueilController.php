<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individu;

class AccueilController extends Controller
{
     public function accueil(Request $request) {
     	$candidat = new Candidat;
     	$individu = new Individu:

     	$candidats = $candidat::all();

     	foreach ($candidats as $key => $value) {
     		
     		$parrain->

     	}



     	return view('home',array('candidats' => $candidats));
     }
}
