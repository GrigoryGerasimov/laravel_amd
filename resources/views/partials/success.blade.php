@if(Session::has('success_msg'))
    <x-common.alert type='success'>
        {{ Session::get('success_msg') }}
    </x-common.alert>
@endif
