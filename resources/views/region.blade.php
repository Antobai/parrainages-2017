@extends('layouts.app')
@section('content')
  <h1><i class="fa fa-map-marker"></i> Parrains de la région {{ $nom }}</h1>
  <hr>
    @if (count($parrains) == 0)
    <div class="alert alert-warning">
      Aucun parrainage dans cette région
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
      @endforeach
    </ul>
    @endif

@endsection
