@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        @include('partials.success')
        <table class="table table-hover table-striped">
            <thead>
            <tr class='text-center'>
                <th>ID</th>
                <th>Season</th>
                <th>SKU</th>
                <th>Brand</th>
                <th>Article</th>
                <th>Color</th>
                <th>Size</th>
                <th>EAN/GTIN</th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
               <td colspan='9'>
                   <a class='btn btn-outline-warning' href='{{ route('amd.create') }}'>New SKU</a>
               </td>
            </tr>
            </tfoot>
            <tbody>
            @foreach($articlesList as $article)
                <tr class='text-center align-middle'>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->season_id }}</td>
                    <td>{{ $article->buying_article_sku }}</td>
                    <td>{{ $article->brand_id }}</td>
                    <td>{{ $article->supplier_article_form }}-{{ $article->supplier_article_number }} {{ $article->supplier_article_name }}</td>
                    <td>{{ $article->color_id }}</td>
                    <td>{{ $article->size_id }}</td>
                    <td>{{ $article->ean_gtin }}</td>
                    <td>
                        <a class='btn btn-outline-dark' href='{{ route('amd.show', $article) }}'>
                            {{ __('Details') }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
