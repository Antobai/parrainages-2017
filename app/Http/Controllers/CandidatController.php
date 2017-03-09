<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Individu;
use App\Candidat;
use DB;


class CandidatController extends Controller
{
   	public function showCandidat($id) {

   		$individu = new Individu;
      $candidat = new Candidat;

      $candidat = $candidat::select("nom","prenom")->where('id', $id)->first();

      $parrains = $individu
            ->select('individus.*','departements.nom AS nomDepartement','departements.id AS idDepartement','communes.nom AS nomCommune','regions.nom AS nomRegion','mandats.nom AS nomMandat')
            ->join('candidats', 'candidats.id', '=', 'individus.id_candidat')
            ->leftJoin('departements', 'departements.id', '=', 'individus.id_departement')
            ->leftJoin('communes', 'communes.id', '=', 'individus.id_commune')
            ->leftJoin('regions', 'regions.id', '=', 'individus.id_region')
            ->leftJoin('mandats', 'mandats.id', '=', 'individus.id_mandat')
            ->where("individus.id_candidat",$id)
            ->get();

      return view('candidat', array('candidat'=>$candidat,'parrains' => $parrains));

   	}

    public function showAllCandidats() {
        $candidat = new Candidat;
        $individu = new Individu;
        $candidats = $candidat::all();
        
        foreach ($candidats as $key => $candidat) {
          $candidat->compte = $individu::select(DB::raw('COUNT(*) as compte'))->where("id_candidat",$candidat->id)->first();
        }

        return view('candidats', array('candidats' => $candidats));
    }
}