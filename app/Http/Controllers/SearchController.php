<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    // recherche full
    public function index(Request $request)
    {

          // recherche parrains
          $datas['individus'] = \App\Individu::where('nom', 'LIKE', '%'.$request->input('query').'%')->get();

          // recherche communes
          $datas['communes'] = \App\Commune::where('nom', 'LIKE', '%'.$request->input('query').'%')
          ->orWhere('code', 'LIKE', '%'.$request->input('query').'%')
          ->get();

          // recherche département
          $datas['departements'] = \App\Departement::where('nom', 'LIKE', '%'.$request->input('query').'%')

          ->orWhere('code', 'LIKE', '%'.$request->input('query').'%')

          ->get();

          // recherche région
          $datas['regions'] = \App\Region::where('nom', 'LIKE', '%'.$request->input('query').'%')->get();

          return view('search', ['datas' => $datas]);

    }
}
