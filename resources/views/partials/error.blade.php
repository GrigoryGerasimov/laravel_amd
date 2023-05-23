@if(Session::has('error_msg'))
    <div class="alert alert-danger">
        {{ Session::get('error_msg') }}
    </div>
@endif
