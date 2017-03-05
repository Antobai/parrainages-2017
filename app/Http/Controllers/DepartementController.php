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
   		$departement = $departement::select("nom")->where('id', $id)->first();
   		if($departement) {
   			$nom = $departement->nom;
   		}

   		$individu = new Individu;
   		$parrains = $individu::select("*")->where('id_departement', $id)->get();

   		$candidat = new Candidat;
   		foreach ($parrains as $key => $parrain) {

   			$candidatResult = $candidat::select("nom","prenom")->where('id', $parrain->id_candidat)->first();

   			if($candidatResult) {
   				$parrain->nomCandidat = $candidatResult->nom;
   				$parrain->prenomCandidat = $candidatResult->prenom;
   			}
   		}
   		

   	

   		return view('departement', array('id' => $id,'nom'=>$nom, 'parrains' => $parrains));
   	}
}
