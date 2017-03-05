<?php
//https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individu;
use App\Departement;
use App\Region;
use App\Circonscription;

class InsertController extends Controller
{

	private function insertRegions() {
		$regions = json_decode(file_get_contents(''), true);

		var_dump($regions);

		foreach ($regions as $key => $value) {

			var_dump($value);

			$region = new Region;



		}
	}

	private function insertCirconscription() {

	}

	private function insertDepartements() {
		
		$row = 1;
		if (($handle = fopen("http://sql.sh/ressources/sql-departement-france/departement.csv", "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$num = count($data);
				$row++;
				

				$departement = new Departement;
									
				
				$departement->nom = $data[2];
				$departement->code = $data[1];
				$departement->id_region = 0;
				
				$departementResponse = $departement->save();
				if(!$departementResponse) {
					var_dump($data);
				}
				

			}
			fclose($handle);
		}


	}


	private function insertCandidat($candidat) {
		if(substr_count($candidat['Candidat-e parrainé-e'], " ") <= 1) {
			$tableNom = explode(" ", $candidat['Candidat-e parrainé-e']);
		}
		else {
			$tableNom = explode(" ", $candidat['Candidat-e parrainé-e']);
			$tableNom[0] .= $tableNom[1];
			$tableNom[1] = $tableNom[2];
		}
		

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
        		$individus->mandat = $parrain["Mandat"];
        		$individus->id_candidat = $candidat_id;
        		$individus->parrainage_publication_date = date('Y-m-d 00:00:00', strtotime(str_replace ('/', '-', $parrain["Date de publication"])));


        		$departementClass = new Departement;
        		$departementExists = $departementClass::select("id")->where('nom', $parrain["Département"])->first();

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

    	$this->insertDepartements();

    	
    	$infos = json_decode(file_get_contents('https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569'), true);
    	
    	foreach ($infos as $key => $candidat) {

    		$id_candidat = $this->insertCandidat($candidat);
    		
    		foreach ($candidat["Parrainages"] as $key => $parrain) {
    			$this->insertIndividu($parrain,$id_candidat);
    		}

    	}

    	$this->insertRegions();


    		

    	//return echo $insertResponse;
    }


}