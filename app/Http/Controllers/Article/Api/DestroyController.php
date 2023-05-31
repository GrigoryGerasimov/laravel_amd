<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Article\Api\ArticleApiService;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

final class DestroyController extends Controller
{
    public function __invoke(Article $article): JsonResponse
    {
        $deleted = ArticleApiService::delete($article);

        return response()->json($deleted ? ['deleted' => true] : ['deleted' => false]);
    }
}
