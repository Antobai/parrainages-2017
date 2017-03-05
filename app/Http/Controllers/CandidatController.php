<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individu;

class CandidatController extends Controller
{
   	public function showCandidat($id) {
   		$candidatClass  = new Candidat;
   		$parrainClass   = new Individu;
      $parrains       = $parrainClass::where('id_candidat', $id)->get();
   		$candidat       = $candidatClass::where('id', $id)->get();
   		return view('candidat', array('id' => $id, 'nom' => $candidat[0]->nom, 'parrain' => $parrains));
   	}

    public function showAllCanditats() {
        $candidat = new Candidat;
        $candidats = $candidat::all();
        return view('candidats', array('candidats' => $candidats));
    }
}