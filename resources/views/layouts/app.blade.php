<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset( '/css/app.css' ) }}" rel="stylesheet">
    <link href="{{ asset( '/css/style.css' ) }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield( 'head' )

</head>
<body>

    <nav class="navbar navbar-default navbar-static-top">
        <div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">{{ config( 'app.name' ) }}</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if( Auth::check() )
                        <li>
    						<form class="navbar-form full-width">
    							<div class="form-group">
    								<input type="text" class="form-control" placeholder="Enter keyword" id="global_search">
                                    <div id="search_results">
                                        <ul>

                                        </ul>
                                    </div>
    							</div>
    						</form>
    					</li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->fullName() }} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route( 'user_tasks', Auth::user() ) }}">My Tasks</a></li>
                                <li class="divider"></li>
                                <li><a href="{{ route( 'auth.logout' ) }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ route( 'auth.login' ) }}">Login / Register</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @if( Auth::check() )
    <div class="page-content page-content-popup">

            @include('layouts.admin.sidebar')


        <div class="page-fixed-main-content">
            <div class="row">
                <div class="col-xs-offset-1 col-xs-10 col-md-offset-0 col-md-12">
                    @if( Session::has( 'alert' ) )

                        <?php $alert = Session::get( 'alert' ); ?>
                        <div class="alert alert-{{ $alert[ 'type' ] }}">
                            {{ $alert[ 'message' ] }}
                        </div>

                    @endif
                </div>
            </div>

            @include('layouts.flash')

            @yield('content')


        </div>
    </div>
@else
    @yield('content')
    @endif



    <!-- Scripts -->
    <script src="{{ asset( '/js/app.js' ) }}"></script>

    @yield( 'footer' )
</body>
</html>
