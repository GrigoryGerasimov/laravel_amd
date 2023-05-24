<table {{ $attributes->merge(['class' => "table $addClasses"]) }}>
    <x-table.table-header :$columns :$isDetailed/>
    <x-table.table-footer :$isDetailed/>
    <x-table.table-body :$articlesList :$article :$isDetailed>
        <x-slot:list>
            @includeWhen(!$isDetailed, 'partials.articleslist')
        </x-slot:list>
        <x-slot:unit>
            @includeWhen($isDetailed, 'partials.article')
        </x-slot:unit>
    </x-table.table-body>
</table>
