<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Candidat;

class CandidatController extends Controller
{
   	public function showCandidat($id) {

   		$candidatClass = new Candidat;


   		$candidat = $candidatClass::where('id', $id)
               ->get();

               var_dump($candidat);

   		return view('candidat',array('id' =>$id));

   	}
}