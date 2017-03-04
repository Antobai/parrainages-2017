<?php
//https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;

class InsertController extends Controller
{
    public function insert(Request $request) {

    	
    	$infos = json_decode(file_get_contents('https://presidentielle2017.conseil-constitutionnel.fr/?dwl=1569'), true);

    	foreach ($infos as $key => $candidat) {

    		$tableNom = explode(" ", $candidat['Candidat-e parrainé-e']);

    		$candidat = new Candidat;

        	$candidat->nom = $tableNom[0];
        	$candidat->prenom = $tableNom[1];
        	//$candidat->couleur = "";
	
        	$insertResponse = $candidat->save();

        	var_dump($insertResponse);

    	}

    	//return echo $insertResponse;
    }


}