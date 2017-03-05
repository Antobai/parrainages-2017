<?php
//https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;
use App\Individu;
use App\Departement;
use App\Region;
use App\Circonscription;
use App\Mandat;

class InsertController extends Controller
{

	private function insertMandat ($nom_mandat) {

		$mandat = new Mandat;

		$mandatExists = $mandat::select("id")->where('nom', $nom_mandat)->first();

		if($mandatExists) {
			return $mandatExists->id;
		}

		$mandat->nom = $nom_mandat;

		$mandat->save();

		return $mandat->id;

	}

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
									
				if($data[2] == "Ile-et-Vilaine") {
					$data[2] = "Ille-et-Vilaine";
				}
				if($data[2] == "Corse-du-sud") {
					$data[2] = "Corse du sud";
				}
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
        	$candidat->couleur = "";
	
        	$insertResponse = $candidat->save();
        	return $candidat->id;
    	
	}

	private function insertIndividu($parrain,$id_candidat,$id_mandat,$id_commune,$id_circonscription,$id_departement,$id_region) {
        		
        		$individus = new Individu;

        		$individus->civilite = $parrain["Civilité"];
        		$individus->prenom = $parrain["Prénom"];
        		$individus->nom = $parrain["Nom"];
        		$individus->id_mandat = $id_mandat;
        		$individus->id_candidat = $id_candidat;
        		$individus->parrainage_publication_date = date('Y-m-d 00:00:00', strtotime(str_replace ('/', '-', $parrain["Date de publication"])));


        		
        		$individus->id_departement = $id_departement;
        		$individus->id_commune = $id_commune;
        		$individus->id_circonscription = $id_circonscription;
        		$individus->id_region = $id_region;

        		$individus->save();
        		return $individus->id;

	}

    public function insert(Request $request) {

    	//1 Conseiller/ère départemental-e"
		//2 Maire"
		//3 Maire délégué-e"
		//4 Sénateur/trice"
		//5 Président-e d'un conseil de communauté de communes"
		//6 Membre de l'assemblée de Corse"
		//7 Député-e"
		//8 Conseiller/ère régional-e"
		//9 Membre du Conseil de Paris"
		//10 Conseiller/ère métropolitain-e de Lyon"
		//11 Maire d'arrondissement"
		//12 Membre élu-e de l'assemblée des Français de l'étranger"
		//13 Représentant-e français-e au Parlement européen"
		//14 Président-e d'un conseil de métropole"
		//15 Président-e d'un conseil de communauté urbaine"
		//16 Président-e d'un conseil de communauté d'agglomération"


    	$this->insertDepartements();
    	$departementClass = new Departement;

    	
    	$infos = json_decode(file_get_contents('https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569'), true);
    	
    	foreach ($infos as $key => $candidat) {

    		$id_candidat = $this->insertCandidat($candidat);
    		
    		foreach ($candidat["Parrainages"] as $key => $parrain) {

    			$id_mandat = $this->insertMandat($parrain["Mandat"]);

    			$id_commune = 0;
    			$id_circonscription = 0;
    			$id_departement = 0;
    			$id_region = 0;

    			$findDepartement =  $departementClass::select("id")->where('nom', $parrain["Département"])->first();

    			if($findDepartement) {
    				$id_departement = $results->id;
    			}

    			$id_individu = $this->insertIndividu($parrain,$id_candidat,$id_mandat,$id_commune,$id_circonscription,$id_departement,$id_region);

    		}

    	}

    	//$this->insertRegions();


    		

    	//return echo $insertResponse;
    }


}