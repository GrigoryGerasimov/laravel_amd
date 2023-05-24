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
            <x-common.button-link
                styling='outline'
                category='secondary'
                :route="route('#')"
            >
                <small>{{ __('Edit') }}</small>
            </x-common.button-link>
            <x-common.button-link
                styling='outline'
                category='danger'
                :route="route('#')"
            >
                <small>{{ __('Delete') }}</small>
            </x-common.button-link>
        </div>
    </td>
@endcan
