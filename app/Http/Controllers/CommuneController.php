<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commune;
use App\Individu;
use App\Candidat;

class CommuneController extends Controller
{
    public function showCommune($id) {
   		$commune = new Commune;
   		$commune = $commune::select("nom")->where('id', $id)->first();

   		if($commune) {
   			$nom = $commune->nom;
   			$code = $commune->code;
   		}

   		$individu = new Individu;
   		$parrains = $individu::select("*")->where('id_commune', $id)->get();

   		$candidat = new Candidat;

   		foreach ($parrains as $key => $parrain) {

   			$candidatResult = $candidat::select("nom","prenom")->where('id', $parrain->id_candidat)->first();

   			if($candidatResult) {
   				$parrain->nomCandidat = $candidatResult->nom;
   				$parrain->prenomCandidat = $candidatResult->prenom;
   				$parrain->idCandidat = $candidatResult->id;
   			}
   		}

   		return view('commune', array('id' => $id,'nom'=>$nom, 'code' => $code, 'parrains' => $parrains));
   	}
}
