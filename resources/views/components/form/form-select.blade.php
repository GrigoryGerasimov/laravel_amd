<div class='form-group mt-3'>
    <label for='{{ $tAttr }}'>
        {{ $title ?? ucfirst(substr($tAttr, 0, -3)) }}
    </label>
    <select id='{{ $tAttr }}' name='{{ $tAttr }}' class='form-select @error($tAttr) is-invalid @enderror'>
        @foreach($list as $item)
            <option
                value='{{ $item->id }}' @selected((old($tAttr) ?? $unit->$tAttr) == $item->id)>{{ $item->name ?? $item->code }}</option>
        @endforeach
    </select>
    @error($tAttr)
    <span class='text-danger'>{{ $message }}</span>
    @enderror
</div>
