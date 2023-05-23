@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        @include('partials.success')
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Supplier Article Number</th>
                <th>Supplier Article Name</th>
                <th>Supplier Color Code</th>
                <th>Supplier Color Name</th>
                <th>Supplier Size</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($articlesList as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td>{{ $article->supplier_article_number }}</td>
                    <td>{{ $article->supplier_article_name }}</td>
                    <td>{{ $article->supplier_color_code }}</td>
                    <td>{{ $article->supplier_color_name }}</td>
                    <td>{{ $article->supplier_size }}</td>
                    <td>
                        <a class='btn btn-outline-primary' href='#'>
                            {{ __('Details') }}
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </section>
@endsection
