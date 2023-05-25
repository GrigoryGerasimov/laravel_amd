@php
    $flashedSuccessMessage = 'success_msg';
    $columns = ['ID', 'SKU', 'Article Name', 'EAN/GTIN', 'Article Code', 'Size', 'Color', 'Brand', 'Season', ''];
    $tableAttr = ['id', 'buying_article_sku', 'supplier_article_name', 'ean_gtin'];
    $metaAttrWithNames = ['color', 'brand', 'season'];
    $metaAttrWithCodes = ['size'];
@endphp

@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        <x-common.alert type='success' :message="$flashedSuccessMessage">
            {{ Session::get($flashedSuccessMessage) }}
        </x-common.alert>

        <x-table.table
            addClasses='table-hover table-striped'
        >
            <x-table.table-header :$columns>
                @foreach($columns as $column)
                    <th>{{ $column }}</th>
                @endforeach
            </x-table.table-header>

            <x-table.table-footer>
                @can('create')
                    <td colspan='10'>
                        <x-common.button-link
                            styling='outline'
                            category='warning'
                            :route="route('amd.create')"
                        >
                            {{ __('New SKU') }}
                        </x-common.button-link>
                    </td>
                @endcan
            </x-table.table-footer>

            <x-table.table-body>
                @forelse($articlesList as $article)
                    <tr>
                        @foreach($tableAttr as $tAttr)
                            <td>{{ $article->$tAttr }}</td>
                        @endforeach

                        <td>
                            {{ $article->supplier_article_form }}
                            -{{ $article->supplier_article_number }}
                            -{{ $article->color->code }}
                        </td>

                        @foreach($metaAttrWithCodes as $cAttr)
                            <td>{{ $article->$cAttr->code }}</td>
                        @endforeach
                        @foreach($metaAttrWithNames as $nAttr)
                            <td>{{ $article->$nAttr->name }}</td>
                        @endforeach
                        <td>
                            <x-common.button-link
                                styling='outline'
                                category='dark'
                                :route="route('amd.show', $article)"
                            >
                                {{ __('Details') }}
                            </x-common.button-link>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan='9'>No article positions available</td>
                    </tr>
                @endforelse
            </x-table.table-body>
        </x-table.table>
    </section>
@endsection
