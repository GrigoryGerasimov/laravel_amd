<thead>
<tr class='text-center'>
    @foreach($columns as $column)
        @if($isDetailed) <th><small>{{ $column }}</small></th> @else <th>{{ $column }}</th> @endif
    @endforeach
</tr>
</thead>
