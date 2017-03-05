<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Parrainages aux élections présidentielles 2017">
        <meta name="author" content="Access Code School | Hackhaton 2017 ">
        <title>Parrainages Présidentielles 2017</title>
        <link href="/css/app.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><i class="fa fa-users"></i> Parrainages 2017</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="/"><i class="fa fa-home fa-fw"></i> Accueil</a></li>
                        <li><a href="/candidats"><i class="fa fa-user fa-fw"></i> Candidats</a></li>
                        <li><a href="/parrains"><i class="fa fa-user-o fa-fw"></i> Parrains</a></li>
                    </ul>
                    <form class="navbar-form navbar-left" method="get" action="{{ url('/search')}}">
                      <div class="form-group">
                        <input type="text" class="form-control" name="query" placeholder="Parrain, commune, département, région">
                      </div>
                      <button type="submit" class="btn btn-default btn-success">
                          <i class="fa fa-search"></i>
                      </button>
                  </form>
                </div>
            </div>
        </nav>
        <div class="container" style="margin-top: 80px;">
            @yield('content')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="/js/app.js"></script>
        <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet.js"></script>
        @yield('after_js')
    </body>
</html>
