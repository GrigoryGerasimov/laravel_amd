<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Services\Article\Api\ArticleApiService;
use App\Models\Article;
use Illuminate\Foundation\Http\FormRequest;

final class UpdateController extends Controller
{
    public function __invoke(Article $article, FormRequest $request): ArticleResource
    {
        $article = ArticleApiService::update($article, $request);

        return new ArticleResource($article);
    }
}
