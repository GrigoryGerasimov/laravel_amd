<div class='form-group mt-3'>
    <label for='{{ $tAttr }}'>
        {{ $title ?? ucwords(str_replace('_', ' ', $tAttr)) }}
    </label>
    <input id='{{ $tAttr }}' name='{{ $tAttr }}'
           class='form-control @error($tAttr) is-invalid @enderror'
           value='{{ old($tAttr) ?? (!is_null($unit) ? $unit->$tAttr : null) }}'/>
    @error($tAttr)
    <span class='text-danger'>{{ $message }}</span>
    @enderror
</div>
