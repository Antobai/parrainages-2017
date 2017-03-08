@extends('layouts.app')
@section('content')
  <h1><i class="fa fa-map-marker"></i> Parrains pour la commune {{ $nom }} <small>{{ $code }}</small></h1>
  <hr>
    @if (count($parrains) == 0)
    <div class="alert alert-warning">
      Aucun parrainage...
    </div>
    @else
    <ul class="list-group">
      @foreach ($parrains as $key => $parrain)
        <li class="list-group-item">
        <i class="fa fa-user-o"></i>
        {{ $parrain->civilite }}. {{ $parrain->nom }} {{ $parrain->prenom }}
        <span class="pull-right">
        parraine <i class="fa fa-user"></i>
        <a href="{{ url('/candidat', $parrain->idCandidat)}}">
          {{ $parrain->prenomCandidat }} {{ $parrain->nomCandidat }}
        </a>
        </span>
      </li>
      @endforeach
    </ul>
    @endif
  </ul>

@endsection
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="/js/app.js"></script>
  <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
