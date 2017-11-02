@extends( 'layouts.app' )

@section( 'content' )
    <a href="{{ route( 'auth.google.login' ) }}" class="btn btn-primary">Login with Google</a>
@endsection
