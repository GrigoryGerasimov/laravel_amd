<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Services\Article\Api\ArticleApiService;

final class RestoreController extends Controller
{
    public function __invoke(string $id): ArticleResource
    {
        $restoredArticle = ArticleApiService::restore($id);

        return new ArticleResource($restoredArticle);
    }
}
