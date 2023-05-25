@php $flashedFailureMessage = 'error_msg'; @endphp

@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        <x-common.alert type='danger' :message="$flashedFailureMessage">
            {{ Session::get($flashedFailureMessage) }}
        </x-common.alert>

        <x-form.form route="{{ route('amd.update', $article) }}" method='PATCH'>

            <x-form.form-select tAttr='season_id' :unit="$article" :list="$seasonsList"/>

            <x-form.form-control tAttr='buying_article_sku' :unit="$article"/>
            <x-form.form-control tAttr='buying_article_config' :unit="$article"/>

            <x-form.form-select tAttr='brand_id' :unit="$article" :list="$brandsList"/>

            <x-form.form-control tAttr='supplier_article_form' :unit="$article"/>
            <x-form.form-control tAttr='supplier_article_number' :unit="$article"/>
            <x-form.form-control tAttr='supplier_article_name' :unit="$article"/>

            <x-form.form-select tAttr='color_id' title='Supplier Article Color' :unit="$article" :list="$colorsList"/>
            <x-form.form-select tAttr='size_id' title='Supplier Article Size' :unit="$article" :list="$sizesList"/>

            <x-form.form-control tAttr='ean_gtin' title='EAN/GTIN' :unit="$article"/>

            <x-form.form-select tAttr='country_id' title='Country of Origin' :unit="$article" :list="$countriesList"/>

            <x-form.form-control tAttr='hs_code' title='HS Code' :unit="$article"/>

            <input type='hidden' id='user_id' name='user_id' value='{{ Auth::user()->id }}'/>

            <div class='btn-group col-12 mt-5'>
                <x-common.button-link
                    styling='outline'
                    category='secondary'
                    :route="route('amd.show', $article)"
                >
                    {{ __('Back') }}
                </x-common.button-link>
                <x-common.button
                    type='reset'
                    styling='outline'
                    category='primary'
                >
                    {{ __('Reset') }}
                </x-common.button>
                <x-common.button
                    type='submit'
                    styling='outline'
                    category='success'
                    shouldDisableOnErrors='true'
                >
                    {{ __('Submit') }}
                </x-common.button>
            </div>

        </x-form.form>
    </section>
@endsection
