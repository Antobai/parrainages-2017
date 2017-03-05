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

class ParrainController extends Controller
{

	public function showAllParrains() {
		
        $parrain = new Individu;
        $parrains = $parrain::all();

        return view('parrains', array('parrains' => $parrains));

    }
}