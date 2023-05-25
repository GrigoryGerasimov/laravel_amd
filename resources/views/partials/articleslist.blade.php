@forelse($articlesList as $article)
    <tr>
        <td>{{ $article->id }}</td>
        <td>{{ $article->season->name }}</td>
        <td>{{ $article->buying_article_sku }}</td>
        <td>{{ $article->brand->name }}</td>
        <td>{{ $article->supplier_article_form }}
            -{{ $article->supplier_article_number }}
            -{{ $article->color->code }}
            </td>
        <td>{{ $article->supplier_article_name }}</td>
        <td>{{ $article->color->name }}</td>
        <td>{{ $article->size->code }}</td>
        <td>{{ $article->ean_gtin }}</td>
        <td>
            <x-common.button-link
                styling='outline'
                category='dark'
                :route="route('amd.show', $article)"
            >
                {{ __('Details') }}
            </x-common.button-link>
        </td>
    </tr>
@empty
    <tr>
        <td colspan='9'>No article positions available</td>
    </tr>
@endforelse
