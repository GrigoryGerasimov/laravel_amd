@php
    $flashedSuccessMessage = 'success_msg';
    $columns = [
        'ID', 'Created At', 'Updated At', 'SKU', 'SKU-Config', 'Article Form',
        'Article Number', 'Article Name', 'EAN/GTIN', 'HS Code', 'Size', 'Color',
        'Brand', 'Season', 'Country of Origin', 'Last Change By'
        ];
    $tableAttr = [
        'id', 'created_at', 'updated_at', 'buying_article_sku', 'buying_article_config',
        'supplier_article_form', 'supplier_article_number', 'supplier_article_name',
        'ean_gtin', 'hs_code'
        ];
    $metaAttrWithNames = ['color', 'brand', 'season', 'country', 'user'];
    $metaAttrWithCodes = ['size'];
@endphp

@extends('layouts.app')

@section('content')
    <section class="px-5 col-md-12">
        <x-common.alert type='success' :message="$flashedSuccessMessage">
            {{ Session::get($flashedSuccessMessage) }}
        </x-common.alert>

        <x-table.table addClasses='table-hover'>
            <x-table.table-header :$columns>
                @foreach($columns as $column)
                    <th><small>{{ $column }}</small></th>
                @endforeach
            </x-table.table-header>

            <x-table.table-footer>
                <td colspan='16'>
                    <x-common.button-link
                        styling='outline'
                        category='dark'
                        :route="route('amd.index')"
                    >
                        {{ __('Back') }}
                    </x-common.button-link>
                </td>
            </x-table.table-footer>

            <x-table.table-body>
                <tr>
                    @foreach($tableAttr as $tAttr)
                        <td><small>{{ $article->$tAttr }}</small></td>
                    @endforeach
                    @foreach($metaAttrWithCodes as $cAttr)
                        <td><small>{{ $article->$cAttr->code }}</small></td>
                    @endforeach
                    @foreach($metaAttrWithNames as $nAttr)
                        <td><small>{{ $article->$nAttr->name }}</small></td>
                    @endforeach
                    @can('manage')
                        <td>
                            <div class='btn-group-vertical'>
                                <x-common.button-link
                                    styling='outline'
                                    category='secondary'
                                    :route="route('amd.edit', $article)"
                                >
                                    <small>{{ __('Edit') }}</small>
                                </x-common.button-link>
                                <x-common.button-link
                                    styling='outline'
                                    category='danger'
                                    :route="route('amd.destroy', $article)"
                                >
                                    <small>{{ __('Delete') }}</small>
                                </x-common.button-link>
                            </div>
                        </td>
                    @endcan
                </tr>

            </x-table.table-body>
        </x-table.table>
    </section>
@endsection
