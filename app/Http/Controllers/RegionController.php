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
   		$parrains = $individu            
            ->select('individus.*', 'candidats.nom AS nomCandidat', 'candidats.prenom AS prenomCandidat')
            ->join('candidats', 'candidats.id', '=', 'individus.id_candidat')
            ->where("individus.id_region",$id)
            ->get();




   		return view('region', array('id' => $id,'nom'=>$nom, 'parrains' => $parrains));
   	}
}
