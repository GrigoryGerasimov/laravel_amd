@extends('layouts.app')

@section('content')
    <section class="offset-md-1 col-md-10">
        @include('partials.error')
        <form action='{{ route('amd.store') }}' method='POST' enctype='application/x-www-form-urlencoded'>
            @csrf
            <div class='form-group mt-3'>
                <label for='buying_article_sku'>Buying Article SKU</label>
                <input id='buying_article_sku' name='buying_article_sku' class='form-control' value='{{ old('buying_article_sku') }}'/>
                @error('buying_article_sku')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='buying_article_config'>Buying Article Config</label>
                <input id='buying_article_config' name='buying_article_config' class='form-control' value='{{ old('buying_article_config') }}'/>
                @error('buying_article_config')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='brand_name'>Brand Name</label>
                <input id='brand_name' name='brand_name' class='form-control' value='{{ old('brand_name') }}'/>
                @error('brand_name')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_article_number'>Supplier Article Number</label>
                <input id='supplier_article_number' name='supplier_article_number' class='form-control' value='{{ old('supplier_article_number') }}'/>
                @error('supplier_article_number')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_article_name'>Supplier Article Name</label>
                <input id='supplier_article_name' name='supplier_article_name' class='form-control' value='{{ old('supplier_article_name') }}'/>
                @error('supplier_article_name')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_color_code'>Supplier Color Code</label>
                <input id='supplier_color_code' name='supplier_color_code' class='form-control' value='{{ old('supplier_color_code') }}'/>
                @error('supplier_color_code')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_color_name'>Supplier Color Name</label>
                <input id='supplier_color_name' name='supplier_color_name' class='form-control' value='{{ old('supplier_color_name') }}'/>
                @error('supplier_color_name')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='supplier_size'>Supplier Size</label>
                <input id='supplier_size' name='supplier_size' class='form-control' value='{{ old('supplier_size') }}'/>
                @error('supplier_size')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='EAN/GTIN'>EAN/GTIN</label>
                <input id='EAN/GTIN' name='EAN/GTIN' class='form-control' value='{{ old('EAN/GTIN') }}'/>
                @error('EAN/GTIN')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='country_of_origin'>Country of Origin</label>
                <input id='country_of_origin' name='country_of_origin' class='form-control' value='{{ old('country_of_origin') }}'/>
                @error('country_of_origin')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <div class='form-group mt-3'>
                <label for='textile_outer_material'>Textile Outer Material</label>
                <input id='textile_outer_material' name='textile_outer_material' class='form-control' value='{{ old('textile_outer_material') }}'/>
                @error('textile_outer_material')
                <span class='text-danger'>{{ $message }}</span>
                @enderror
            </div>

            <input type='hidden' id='user_id' name='user_id' value='{{ Auth::user()->id }}'/>

            <button class='btn btn-success mt-3'>Submit</button>
        </form>
    </section>
@endsection
