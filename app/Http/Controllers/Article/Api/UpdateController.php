<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Services\Article\Api\ArticleApiService;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

final class UpdateController extends Controller
{
    public function __invoke(Article $article, FormRequest $request): ArticleResource|JsonResponse
    {
        $result = ArticleApiService::update($article, $request);

        return $result instanceof Model ? new ArticleResource($result) : response()->json($result, 422);
    }
}
