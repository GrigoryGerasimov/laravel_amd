<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\Article\Web\ArticleWebService;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;

final class DestroyController extends Controller
{
    public function __invoke(Article $article): RedirectResponse
    {
        ArticleWebService::delete($article);

        return redirect(route('amd.index'));
    }
}
