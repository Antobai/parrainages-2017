@extends('layouts.app')
@section('content')
    <h1>Liste des candidats</h1>
    <ul class="list-group">
        @foreach ($candidats as $candidat)
            <li class="list-group-item"><a href="candidat/{{$candidat->id}}"> {{ $candidat->prenom }} {{ $candidat->nom }} </a> <span class="badge">{{$candidat->count}} parrainage(s)</span></li>
        @endforeach
    </ul>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="/js/app.js"></script>
    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
@endsection

