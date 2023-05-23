@if(Session::has('success_msg'))
    <div class="alert alert-success">
        {{ Session::get('success_msg') }}
    </div>
@endif
