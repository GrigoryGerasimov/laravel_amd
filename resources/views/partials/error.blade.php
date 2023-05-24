@if(Session::has('error_msg'))
    <x-common.alert type='danger'>
        {{ Session::get('error_msg') }}
    </x-common.alert>
@endif
