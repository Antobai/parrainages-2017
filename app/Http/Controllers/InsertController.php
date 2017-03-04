<?php
//https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individu;
use App\Departement;

class InsertController extends Controller
{
	private function insertCandidat($candidat) {
		$tableNom = explode(" ", $candidat['Candidat-e parrainé-e']);

    		$candidat = new Candidat;

        	$candidat->nom = $tableNom[0];
        	$candidat->prenom = $tableNom[1];
        	//$candidat->couleur = "";
	
        	$insertResponse = $candidat->save();
        	return $candidat->id;
    	
	}

	private function insertIndividu($parrain,$candidat_id) {
        		
        		$individus = new Individu;

        		$individus->civilite = $parrain["Civilité"];
        		$individus->prenom = $parrain["Prénom"];
        		$individus->nom = $parrain["Nom"];
        		$individus->id_candidat = $candidat_id;
        		$individus->parrainage_publication_date = date('Y-m-d 00:00:00', strtotime(str_replace ('/', '-', $parrain["Date de publication"])));


        		$departementClass = new Departement;
        		$departementExists = $departementClass::select("id")->where('departement_nom', $parrain["Département"])->first();

        		if($departementExists) {
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

    public function insert(Request $request) {

    	
    	$infos = json_decode(file_get_contents('https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569'), true);
    	
    	foreach ($infos as $key => $candidat) {

    		$id_individu = $this->insertCandidat($candidat);
    		
    		foreach ($candidat["Parrainages"] as $key => $parrain) {
    			var_dump($parrain);
    			$this->insertIndividu($parrain,$id_individu);
    		}

    	}


    		

    	//return echo $insertResponse;
    }


}