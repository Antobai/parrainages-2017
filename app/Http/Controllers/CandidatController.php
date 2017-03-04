<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;

class CandidatController extends Controller
{
   	public function showCandidat($id) {
   		$candidatClass = new Candidat;
   		$candidat = $candidatClass::where('id', $id)->get();
   		return view('candidat', array('id' => $id));
   	}

    public function showAllCanditats() {
        $candidat = new Candidat;
        $candidats = $candidat::all();
        return view('candidats', array('candidats' => $candidats));
    }
}