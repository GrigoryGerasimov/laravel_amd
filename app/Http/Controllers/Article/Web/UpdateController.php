<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleUpdateRequest;
use App\Http\Services\ArticleService;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;

final class UpdateController extends Controller
{
    public function __invoke(Article $article, ArticleUpdateRequest $request): RedirectResponse
    {
        $article = ArticleService::update($article, $request->validated());

        return redirect(route('amd.show', $article));
    }
}
