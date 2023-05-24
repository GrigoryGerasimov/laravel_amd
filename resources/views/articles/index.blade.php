@php
    $flashedSuccessMessage = 'success_msg';
    $columns = ['ID', 'Season', 'SKU', 'Brand', 'Article', 'Color', 'Size', 'EAN/GTIN', ''];
@endphp

@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        <x-common.alert type='success' :message="$flashedSuccessMessage">
            {{ Session::get($flashedSuccessMessage) }}
        </x-common.alert>

        <x-table.table
            addClasses='table-hover table-striped'
            :$columns
            :$articlesList
        />
    </section>
@endsection
