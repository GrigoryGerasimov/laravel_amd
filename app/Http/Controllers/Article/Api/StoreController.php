<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Services\Article\Api\ArticleApiService;
use Illuminate\Foundation\Http\FormRequest;

final class StoreController extends Controller
{
    public function __invoke(FormRequest $request): ArticleResource
    {
        $article = ArticleApiService::store($request);

        return new ArticleResource($article);
    }
}
