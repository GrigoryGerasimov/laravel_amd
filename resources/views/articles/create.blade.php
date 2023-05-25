@php $flashedFailureMessage = 'error_msg'; @endphp

@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        <x-common.alert type='danger' :message="$flashedFailureMessage">
            {{ Session::get($flashedFailureMessage) }}
        </x-common.alert>

        <x-form.form
            :$seasonsList
            :$brandsList
            :$colorsList
            :$sizesList
            :$countriesList
            route="{{ route('amd.store') }}"
        />
    </section>
@endsection
