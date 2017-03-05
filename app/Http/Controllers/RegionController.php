<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\Individu;
use App\Candidat;

class RegionController extends Controller
{
    public function showRegion($id) {
   		$region = new Region;
   		$region = $region::select("nom")->where('id', $id)->first();
   		if($region) {
   			$nom = $region->nom;
   		}

   		$individu = new Individu;
   		$parrains = $individu::select("*")->where('id_region', $id)->get();

   		$candidat = new Candidat;
   		
   		foreach ($parrains as $key => $parrain) {

   			$candidatResult = $candidat::select("nom","prenom")->where('id', $parrain->id_candidat)->first();

   			if($candidatResult) {
   				$parrain->nomCandidat = $candidatResult->nom;
   				$parrain->prenomCandidat = $candidatResult->prenom;
   			}
   		}
   		

   	

   		return view('region', array('id' => $id,'nom'=>$nom, 'parrains' => $parrains));
   	}
}
