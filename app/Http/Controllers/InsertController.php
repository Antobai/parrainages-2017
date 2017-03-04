<?php
//https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individus;
use App\Departements;

class InsertController extends Controller
{
    public function insert(Request $request) {

    	
    	$infos = json_decode(file_get_contents('https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569'), true);
    	
    	foreach ($infos as $key => $value) {

    	//echo "<pre>";
    	//var_dump($value);
    	//echo "</pre>";

    		$tableNom = explode(" ", $value['Candidat-e parrainé-e']);

    		$candidat = new Candidat;

        	$candidat->nom = $tableNom[0];
        	$candidat->prenom = $tableNom[1];
        	//$candidat->couleur = "";
	
        	//$insertResponse = $candidat->save();
        	//$lastIdCandidat = $data->id;
        	$lastIdCandidat = 1;

        	foreach ($value['Parrainages'] as $key => $parrain) {
        		
        		$individus = new Individus;

        		$individus->civilite = $parrain["Civilité"];
        		$individus->prenom = $parrain["Prénom"];
        		$individus->nom = $parrain["Nom"];
        		$individus->id_candidat = $lastIdCandidat;
        		$individus->parrainage_publication_date = $parrain["Date de publication"];

        		$departementClass = new Departements;
        		$departementExists = $departementClass::select("id")->where('departement_nom', $parrain["Département"])->first();
               
        		if($departementExists) {
        			$individus->id_departement = $departementExists->id;
        		}
        		else {
        			$individus->id_departement = 0;
        		}
        		


        	}


        	//var_dump($insertResponse);

    	}

    	//return echo $insertResponse;
    }


}