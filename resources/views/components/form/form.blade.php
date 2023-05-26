<form action='{{ $route }}' method='{{ $method }}' enctype='{{ $enctype }}'>
    @csrf

    @switch($bladeMethod)
        @case('PUT')
            @method('put')
            @break;
        @case('PATCH')
            @method('patch')
            @break;
        @case('DELETE')
            @method('delete')
            @break;
    @endswitch

    {{ $slot }}
</form>
