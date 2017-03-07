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
   		$individu = new Individu;
         $parrains = $individu            
            ->select('individus.*', 'candidats.nom AS nomCandidat', 'candidats.prenom AS prenomCandidat')
            ->join('candidats', 'candidats.id', '=', 'individus.id_candidat')
            ->where("individus.id_commune",$id)
            ->get();

   		return view('commune', array('id' => $id,'nom'=>$nom, 'code' => $code, 'parrains' => $parrains));
   	}
}
