@if( $flash_message = session( '_flash_error' ) )
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ $flash_message }}
    </div>
@endif

@if( $flash_message = session( '_flash_success' ) )
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ $flash_message }}
    </div>
@endif

@if( $flash_message = session( '_flash_info' ) )
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ $flash_message }}
    </div>
@endif