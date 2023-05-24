@php $flashedFailureMessage = 'error_msg'; @endphp

@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        <x-common.alert type='danger' :message="$flashedFailureMessage">
            {{ Session::get($flashedFailureMessage) }}
        </x-common.alert>

        <form action='{{ route('amd.store') }}' method='POST' enctype='application/x-www-form-urlencoded'>
            @csrf
            <div class='form-group mt-3'>
                <label for='season_id'>Season</label>
                <select id='season_id' name='season_id' class='form-select @error('season_id') is-invalid @enderror'>
                    @foreach($seasonsList as $season)
                        <option
                            value='{{ $season->id }}' @selected(old('season_id' == $season->id))>{{ $season->name }}</option>
                    @endforeach
                </select>
                @error('season_id')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='buying_article_sku'>Buying Article SKU</label>
                <input id='buying_article_sku' name='buying_article_sku'
                       class='form-control @error('buying_article_sku') is-invalid @enderror'
                       value='{{ old('buying_article_sku') }}'/>
                @error('buying_article_sku')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='buying_article_config'>Buying Article Config</label>
                <input id='buying_article_config' name='buying_article_config'
                       class='form-control @error('buying_article_config') is-invalid @enderror'
                       value='{{ old('buying_article_config') }}'/>
                @error('buying_article_config')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='brand_id'>Brand</label>
                <select id='brand_id' name='brand_id' class='form-select @error('brand_id') is-invalid @enderror'>
                    @foreach($brandsList as $brand)
                        <option
                            value='{{ $brand->id }}' @selected(old('brand_id') == $brand->id)>{{ $brand->name }}</option>
                    @endforeach
                </select>
                @error('brand_id')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_article_form'>Supplier Article Form</label>
                <input id='supplier_article_form' name='supplier_article_form'
                       class='form-control @error('supplier_article_form') is-invalid @enderror'
                       value='{{ old('supplier_article_form') }}'/>
                @error('supplier_article_form')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_article_number'>Supplier Article Number</label>
                <input id='supplier_article_number' name='supplier_article_number'
                       class='form-control @error('supplier_article_number') is-invalid @enderror'
                       value='{{ old('supplier_article_number') }}'/>
                @error('supplier_article_number')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_article_name'>Supplier Article Name</label>
                <input id='supplier_article_name' name='supplier_article_name'
                       class='form-control @error('supplier_article_name') is-invalid @enderror'
                       value='{{ old('supplier_article_name') }}'/>
                @error('supplier_article_name')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='color_id'>Supplier Article Color</label>
                <select id='color_id' name='color_id' class='form-select @error('color_id') is-invalid @enderror'>
                    @foreach($colorsList as $color)
                        <option
                            value='{{ $color->id }}' @selected(old('color_id') == $color->id)>{{ $color->name }}</option>
                    @endforeach
                </select>
                @error('color_id')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='size_id'>Supplier Article Size</label>
                <select id='size_id' name='size_id' class='form-select @error('size_id') is-invalid @enderror'>
                    @foreach($sizesList as $size)
                        <option
                            value='{{ $size->id }}' @selected(old('size_id') == $size->id)>{{ $size->code }}</option>
                    @endforeach
                </select>
                @error('size_id')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='ean_gtin'>EAN/GTIN</label>
                <input id='ean_gtin' name='ean_gtin' class='form-control @error('ean_gtin') is-invalid @enderror'
                       value='{{ old('ean_gtin') }}'/>
                @error('ean_gtin')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='country_id'>Country of Origin</label>
                <select id='country_id' name='country_id' class='form-select @error('country_id') is-invalid @enderror'>
                    @foreach($countriesList as $country)
                        <option
                            value='{{ $country->id }}' @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                    @endforeach
                </select>
                @error('country_id')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='hs_code'>HS Code</label>
                <input id='hs_code' name='hs_code' class='form-control @error('hs_code') is-invalid @enderror'
                       value='{{ old('hs_code') }}'/>
                @error('hs_code')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <input type='hidden' id='user_id' name='user_id' value='{{ Auth::user()->id }}'/>

            <div class='btn-group col-12 mt-5'>
                <x-common.button-link
                    styling='outline'
                    category='secondary'
                    :route="route('amd.index')"
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
        </form>
    </section>
@endsection
