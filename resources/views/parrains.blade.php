@extends('layouts.app')
@section('content')
  <h1><i class="fa fa-user-o"></i> Parrains</h1>
  <hr>
  <ul class="list-group">
    @if (count($parrains) == 0)
    <div class="alert alert-warning">
      Aucun parrain correspondant
    </div>
    @else
      @foreach ($parrains as $key => $parrain)
        <li class="list-group-item">
          <i class="fa fa-user-o"></i>
          {{ $parrain->civilite }}. {{ $parrain->nom }} {{ $parrain->prenom }}
        </li>
      @endforeach
    @endif
  </ul>
@endsection
