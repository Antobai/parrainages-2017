@extends('layouts.app')
@section('content')
  <h1>Parrainages pour {{$prenom}} {{ $nom }} </h1>
  <ul class="list-group">
    @if (count($parrains) == 0)
      Aucun parrainage..
    @else
      @foreach ($parrains as $key => $parrain)
        <li class="list-group-item">{{$key}} - {{ $parrain->civilite }}. {{ $parrain->nom }} {{ $parrain->prenom }} - {{ $parrain->mandat }} - {{ $parrain->departement }} </li>
      @endforeach
    @endif
  </ul>

@endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="/js/app.js"></script>
  <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>

