<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Article\Api\ArticleApiService;
use App\Models\Article;

final class DestroyController extends Controller
{
    public function __invoke(Article $article): bool
    {
        return ArticleApiService::delete($article);
    }
}
