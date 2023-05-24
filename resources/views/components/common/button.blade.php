<button
    type='{{ $type }}'
    class='btn btn-{{ $styling }}-{{ $category }}'
@if($shouldDisableOnErrors) @disabled($errors->any()) @endif
>
    {{ $slot }}
</button>
