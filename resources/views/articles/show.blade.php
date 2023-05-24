@extends('layouts.app')

@section('content')
    <section class="px-5 col-md-12">
        @include('partials.success')
        <table class="table table-hover">
            <thead>
            <tr class='text-center'>
                <th>
                    <small>ID</small>
                </th>
                <th>
                    <small>Season</small>
                </th>
                <th>
                    <small>Buying Article SKU</small>
                </th>
                <th>
                    <small>Buying Article Config</small>
                </th>
                <th>
                    <small>Brand</small>
                </th>
                <th>
                    <small>Supplier Article Form</small>
                </th>
                <th>
                    <small>Supplier Article Number</small>
                </th>
                <th>
                    <small>Supplier Article Name</small>
                </th>
                <th>
                    <small>Color</small>
                </th>
                <th>
                    <small>Size</small>
                </th>
                <th>
                    <small>EAN/GTIN</small>
                </th>
                <th>
                    <small>Country of Origin</small>
                </th>
                <th>
                    <small>HS Code</small>
                </th>
                <th>
                    <small>Added By</small>
                </th>
                <th>
                    <small>Created At</small>
                </th>
                <th>
                    <small>Updated At</small>
                </th>
                @can('manage')
                    <th></th>
                @endcan
            </tr>
            </thead>
            <tfoot>
            <tr>
                <td colspan='16'>
                    <a class='btn btn-outline-dark' href='{{ route('amd.index') }}'>Back</a>
                </td>
            </tr>
            </tfoot>
            <tbody>
            <tr class='text-center align-middle'>
                <td>
                    <small>{{ $article->id }}</small>
                </td>
                <td>
                    <small>{{ $article->season->name }}</small>
                </td>
                <td>
                    <small>{{ $article->buying_article_sku }}</small>
                </td>
                <td>
                    <small>{{ $article->buying_article_config }}</small>
                </td>
                <td>
                    <small>{{ $article->brand->name }}</small>
                </td>
                <td>
                    <small>{{ $article->supplier_article_form }}</small>
                </td>
                <td>
                    <small>{{ $article->supplier_article_number }}</small>
                </td>
                <td>
                    <small>{{ $article->supplier_article_name }}</small>
                </td>
                <td>
                    <small>{{ $article->color->name }}</small>
                </td>
                <td>
                    <small>{{ $article->size->code }}</small>
                </td>
                <td>
                    <small>{{ $article->ean_gtin }}</small>
                </td>
                <td>
                    <small>{{ $article->country->name }}</small>
                </td>
                <td>
                    <small>{{ $article->hs_code }}</small>
                </td>
                <td>
                    <small>{{ $article->user->name }}</small>
                </td>
                <td>
                    <small>{{ $article->created_at }}</small>
                </td>
                <td>
                    <small>{{ $article->updated_at }}</small>
                </td>
                @can('manage')
                    <td>
                        <div class='btn-group-vertical'>
                            <a class='btn btn-outline-secondary' href='#'>
                                <small>{{ __('Edit') }}</small>
                            </a>
                            <a class='btn btn-outline-danger' href='#'>
                                <small>{{ __('Delete') }}</small>
                            </a>
                        </div>
                    </td>
                @endcan
            </tr>
            </tbody>
        </table>
    </section>
@endsection
