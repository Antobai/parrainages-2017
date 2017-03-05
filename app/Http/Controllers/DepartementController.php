<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departement;

class DepartementController extends Controller
{
    public function showDepartement($id) {
   			
   		$departement = new Departement;

   		return view('departement', array('id' => $id, 'nom' => $candidat[0]->nom,
        'prenom'=>$candidat[0]->prenom, 'parrains' => $parrains));
   	}
}
