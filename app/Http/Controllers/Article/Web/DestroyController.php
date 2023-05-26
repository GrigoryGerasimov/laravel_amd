<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Http\Services\ArticleService;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;

final class DestroyController extends Controller
{
    public function __invoke(Article $article): RedirectResponse
    {
        ArticleService::delete($article);

        return redirect(route('amd.index'));
    }
}
