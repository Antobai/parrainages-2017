<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commune;
use App\Region;
use App\Departement;

class GeoController extends Controller
{

    // path des geojson france
    private $jsonPath = '/Users/yves/www/parrainages-2017/resources/france-geojson/';

    // les json
    private $jsonFiles = array(
      'regions' => 'regions-avec-outre-mer.geojson',
      'departements' => 'departements-avec-outre-mer.geojson',
      'communes' => 'communes-avec-outre-mer.geojson',
      //'communes' => 'test.json',
    );

    // retour à la ligne
    private $rtl = "\r\n";

    // récupèrer les datas
    private function getDatasFromJson($jsonType) {
      $datas = json_decode(file_get_contents($this->jsonPath.$this->jsonFiles[$jsonType]));
      return $datas->features;
    }

    // ajouter les communes à partir du geojson
    public function add_communes() {

      $text[] = 'Ajout des communes';

      foreach($this->getDatasFromJson('communes') as $data) {

        // tester si le code postal existe
        if(Commune::where('code', $data->properties->code)->count()==0) {

          /*$text[] = '- Nom : '.$data->properties->nom;
          $text[] = '- Code : '.$data->properties->code;
          $text[] = '- Geojson : '.$data->geometry;*/

          $commune = new Commune;
          $commune->nom = $data->properties->nom;
          $commune->code = $data->properties->code;
          $commune->geojson = json_encode($data->geometry);

          // sauvegarde
          $commune->save();

        }

      }

      return response(implode($this->rtl, $text), 200)->header('Content-Type', 'text/plain');

  }

  // ajouter les régions à partir du geojson
  public function add_regions() {

      $text[] = 'Ajout des regions';

      foreach($this->getDatasFromJson('regions') as $data) {

        // tester si le code postal existe
        if(Region::where('code', $data->properties->code)->count()==0) {

          $text[] = '- Nom : '.$data->properties->nom;
          $text[] = '- Code : '.$data->properties->code;
          $text[] = '- Geojson : '.json_encode($data->geometry);

          $region = new Region;
          $region->nom = $data->properties->nom;
          $region->code = $data->properties->code;
          $region->geojson = json_encode($data->geometry);

          // sauvegarde
          $region->save();

        }

      }

      return response(implode($this->rtl, $text), 200)->header('Content-Type', 'text/plain');

  }

  // ajouter les departements à partir du geojson
  public function add_departements() {

      $text[] = 'Ajout des départements';

      foreach($this->getDatasFromJson('departements') as $data) {

        // tester si le code postal existe
        if(Departement::where('code', $data->properties->code)->count()==0) {

          $text[] = '- Nom : '.$data->properties->nom;
          $text[] = '- Code : '.$data->properties->code;
          $text[] = '- Geojson : '.json_encode($data->geometry);

          $departement = new Departement;
          $departement->nom = $data->properties->nom;
          $departement->code = $data->properties->code;
          $departement->geojson = json_encode($data->geometry);

          // sauvegarde
          $departement->save();

        }

      }

      return response(implode($this->rtl, $text), 200)->header('Content-Type', 'text/plain');

  }

}
