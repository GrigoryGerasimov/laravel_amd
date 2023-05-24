@php
    $flashedSuccessMessage = 'success_msg';
    $columns = [
        'ID',
        'Season',
        'Buying Article SKU',
        'Buying Article Config',
        'Brand',
        'Supplier Article Form',
        'Supplier Article Number',
        'Supplier Article Name',
        'Color',
        'Size',
        'EAN/GTIN',
        'Country of Origin',
        'HS Code',
        'Added By',
        'Created At',
        'Updated At'
        ];
@endphp

@extends('layouts.app')

@section('content')
    <section class="px-5 col-md-12">
        <x-common.alert type='success' :message="$flashedSuccessMessage">
            {{ Session::get($flashedSuccessMessage) }}
        </x-common.alert>

        <x-table.table
            addClasses='table-hover'
            :$columns
            :article="$article"
            :isDetailed='true'
        />
    </section>
@endsection
