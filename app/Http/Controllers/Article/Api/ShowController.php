<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;

final class ShowController extends Controller
{
    public function __invoke(Article $article): ArticleResource
    {
        return new ArticleResource($article);
    }
}
