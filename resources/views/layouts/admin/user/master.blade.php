<!DOCTYPE html>
<html lang="{{ config( 'app.locale' ) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config( 'app.name' ) }}</title>
    
        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

        @yield( 'header_styles' )
    </head>
    <body>
        {{-- Main Nav --}}
        @include( 'layouts.guest.nav' )

        <div class="container">
            {{-- Flash Messages --}}
            @include( 'layouts.flash' )
            
            {{-- Display Dashboard --}}
            @include( 'layouts.user.addtask' )
            
            {{-- Main Content --}}
            @yield( 'content' )
        </div>
    
        {{-- Scripts - Placed at the end of the document so the pages load faster --}}
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
            $( 'document' ).ready( function() {
                $( 'div.alert' ).not( '.alert-important' ).delay( 3000 ).fadeOut( 350 );
            } );
        </script>
    </body>
</html>
