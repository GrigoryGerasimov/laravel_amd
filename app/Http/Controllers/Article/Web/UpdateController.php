<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\Web\ArticleWebUpdateRequest;
use App\Http\Services\Article\Web\ArticleWebService;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;

final class UpdateController extends Controller
{
    public function __invoke(Article $article, ArticleWebUpdateRequest $request): RedirectResponse
    {
        $article = ArticleWebService::update($article, $request);

        return redirect(route('amd.show', $article));
    }
}
