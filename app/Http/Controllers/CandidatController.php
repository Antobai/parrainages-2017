<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individu;
use App\Mandat;
use App\Departement;

class CandidatController extends Controller
{
   	public function showCandidat($id) {
   		$candidatClass  = new Candidat;
   		$parrainClass   = new Individu;
      $mandatClass  = new Mandat;
      $departementClass   = new Departement;


      $parrains = $parrainClass::where('id_candidat', $id)->get();

      foreach ($parrains as $key => $parrain) {

        $mandat = "";
        $mandatExists = $mandatClass::select("nom")->where('id', $parrain->id_mandat)->first();
        if($mandatExists) {
          $mandat = $mandatExists->nom;
        }
        $parrain->mandat = $mandat;

        $departement = "";
        $departementExists = $departementClass::select("nom")->where('id', $parrain->id_departement)->first();
        if($departementExists) {
          $departement = $departementExists->nom;
        }
        $parrain->departement = $departement;
      }

      

   		$candidat = $candidatClass::where('id', $id)->get();

   		return view('candidat', array('id' => $id, 'nom' => $candidat[0]->nom,
        'prenom'=>$candidat[0]->prenom, 'parrains' => $parrains));
   	}

    public function showAllCanditats() {
        $candidat = new Candidat;
        $candidats = $candidat::all();
        return view('candidats', array('candidats' => $candidats));
    }
}