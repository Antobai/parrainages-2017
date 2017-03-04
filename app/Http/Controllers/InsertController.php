<?php
//https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individu;
use App\Departement;

class InsertController extends Controller
{

    public function insert(Request $request) {

    	
    	$infos = json_decode(file_get_contents('https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569'), true);
    	
    	foreach ($infos as $key => $value) {


    		$tableNom = explode(" ", $value['Candidat-e parrainé-e']);

    		$candidat = new Candidat;

        	$candidat->nom = $tableNom[0];
        	$candidat->prenom = $tableNom[1];
        	//$candidat->couleur = "";
	
        	$insertResponse = $candidat->save();
        	$lastIdCandidat = $candidat->id;

        	foreach ($value['Parrainages'] as $key => $parrain) {
        		
        		$individus = new Individu;

        		$individus->civilite = $parrain["Civilité"];
        		$individus->prenom = $parrain["Prénom"];
        		$individus->nom = $parrain["Nom"];
        		$individus->id_candidat = $lastIdCandidat;
        		$individus->parrainage_publication_date = date('Y-m-d 00:00:00', strtotime(str_replace ('/', '-', $parrain["Date de publication"])));


        		$departementClass = new Departement;
        		$departementExists = $departementClass::select("id")->where('departement_nom', $parrain["Département"])->first();

        		if($departementExists) {
        			var_dump($departementExists->id);
        			$individus->id_departement = $departementExists->id;
        		}
        		else {
        			$individus->id_departement = 0;
        		}

        		$individus->id_commune = 0;
        		$individus->id_circonscription = 0;
        		$individus->id_region = 0;

        		$individus->save();
        		


        	}


        	//var_dump($insertResponse);

    	}

    	//return echo $insertResponse;
    }


}