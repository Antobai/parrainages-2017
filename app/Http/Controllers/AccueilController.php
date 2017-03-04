<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;

class AccueilController extends Controller
{
     public function accueil(Request $request) {
     	$candidat = new Candidat;
     	$candidats = $candidat::all();
     	return view('home',array('candidats' => $candidats));
     }
}
