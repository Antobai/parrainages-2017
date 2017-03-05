@extends('layouts.app')
@section('content')
    <form method="get" action="{{ url('/search') }}">
        <div class="form-group">
            <div class="row center-block">
                <div class="col-xs-10" style="padding-right:0;">
                    <input type="search" class="form-control input-lg" name="query" id="query" placeholder="Parrain, commune, région, département">
                </div>
                <div class="col-xs-1" style="padding-left:4px;">
                    <button type="submit" class="btn btn-default btn-lg btn-success"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </form>
    <hr>
    <div>
      <ul class="list-group">
          @foreach ($candidats as $candidat)
              <li class="list-group-item">
                <a href="candidat/{{$candidat->id}}">
                  <i class="fa fa-user fa-fw"></i>
                  {{ $candidat->prenom }} {{ $candidat->nom }} <i class="hidden-xs fa fa-arrow-right"></i>
                </a>
                <span class="badge">{{$candidat->count}} <span class="hidden-xs">parrainage(s)</span></span></li>
          @endforeach
      </ul>
    </div>

@endsection
