@extends('layouts.app')
@section('content')

  <h1><i class="fa fa-search"></i> Recherche</h1>

  <hr>

  <h2><i class="fa fa-user-o fa-fw"></i> Parrains</h1>
    @if (count($datas['individus']) == 0)
    <div class="alert alert-warning">
      Aucun parrainage correspondant
    </div>
    @else
    <ul class="list-group">
      @foreach ($datas['individus'] as $individu)
        <li class="list-group-item">
          <a href="{{ url('individus', $individu->id) }}">
          <i class="fa fa-user-o fa-fw"></i> {{ $individu->nom }} {{ $individu->prenom }}
            <i class="fa fa-arrow-right hidden-xs"></i>
          </a>
        </li>
      @endforeach
    </ul>
    @endif

  <hr>

  <h2><i class="fa fa-map-marker fa-fw"></i> Communes</h1>
    @if (count($datas['communes']) == 0)
    <div class="alert alert-warning">
      Aucune commune correspondante
    </div>
    @else
    <ul class="list-group">
      @foreach ($datas['communes'] as $commune)
        <li class="list-group-item">
          <a href="{{ url('commune', $commune->id) }}">
            <i class="fa fa-map-marker fa-fw"></i> {{ $commune->nom }} <small>({{ $commune->code }})</small>
             <i class="fa fa-arrow-right hidden-xs"></i>
          </a>
      </li>
      @endforeach
    </ul>
    @endif

  <hr>

  <h2><i class="fa fa-map-marker fa-fw"></i> Départements</h1>
      @if (count($datas['departements']) == 0)
    <div class="alert alert-warning">
      Aucun département correspondant...
    </div>
    @else
    <ul class="list-group">
      @foreach ($datas['departements'] as $departement)
        <li class="list-group-item">
          <a href="{{ url('departement', $departement->id) }}">
            <i class="fa fa-map-marker fa-fw"></i> {{ $departement->nom }} <small>({{ $departement->code }})
              <i class="fa fa-arrow-right hidden-xs"></i>
          </a>
      </li>
      @endforeach
    </ul>
    @endif

  <hr>

    <h2><i class="fa fa-map-marker fa-fw"></i> Régions</h1>
      @if (count($datas['regions']) == 0)
    <div class="alert alert-warning">
      Aucune region correspondante...
    </div>
    @else
    <ul class="list-group">
      @foreach ($datas['regions'] as $region)
        <li class="list-group-item">
          <a href="{{ url('region', $region->id) }}">
            <i class="fa fa-map-marker fa-fw"></i> {{ $region->nom }}
            <i class="fa fa-arrow-right hidden-xs"></i>
          </a>
        </li>
      @endforeach
    </ul>
    @endif

@endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="/js/app.js"></script>
  <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
