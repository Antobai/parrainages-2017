<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departement;
use App\Individu;
use App\Candidat;

class DepartementController extends Controller
{
    public function showDepartement($id) {

   		$departement = new Departement;
   		$departement = $departement::where('id', $id)->first();
   		if($departement) {
   			$nom = $departement->nom;
   			$code = $departement->code;
   		}

   		$individu = new Individu;
         $candidat = new Candidat;
         
   		$parrains = $candidat
            ->join('individus', 'candidats.id', '=', 'individus.id_candidat')
            ->select('individus.*', 'candidats.*')
            ->get();

            echo "<pre>";
            var_dump($parrains);
             echo "</pre>";

   
   		
   		
   		foreach ($parrains as $key => $parrain) {

   			$candidatResult = $candidat::select("nom","prenom")->where('id', $parrain->id_candidat)->first();

   			if($candidatResult) {
   				$parrain->nomCandidat = $candidatResult->nom;
   				$parrain->prenomCandidat = $candidatResult->prenom;
   				$parrain->idCandidat = $candidatResult->id;
   			}
   		}

   		return view('departement', array('id' => $id,'nom'=>$nom, 'code' => $code, 'parrains' => $parrains));
   	}
}
