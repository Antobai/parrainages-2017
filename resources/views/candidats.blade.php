@extends('layouts.app')
@section('content')
    <h1><i class="fa fa-user"></i> Candidats</h1>
    <hr>
    <ul class="list-group">
        @foreach ($candidats as $candidat)
            <li class="list-group-item">
              <a href="candidat/{{$candidat->id}}">
                <i class="fa fa-user"></i> {{ $candidat->prenom }} {{ $candidat->nom }}
              </a>
              <span class="badge">{{$candidat->compte->compte}} <span class="hidden-xs">parrainage(s)</span></span></li>
        @endforeach
    </ul>
@endsection
