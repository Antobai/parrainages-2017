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
                  
   		$parrains = $individu            
            ->select('individus.*', 'candidats.nom AS nomCandidat', 'candidats.prenom AS prenomCandidat')
            ->join('candidats', 'candidats.id', '=', 'individus.id_candidat')
            ->where("individus.id_departement",$id)
            ->get();
   		

   		return view('departement', array('id' => $id,'nom'=>$nom, 'code' => $code, 'parrains' => $parrains));
   	}
}
