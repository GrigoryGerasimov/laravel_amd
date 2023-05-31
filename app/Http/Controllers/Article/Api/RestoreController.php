<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Services\Article\Api\ArticleApiService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

final class RestoreController extends Controller
{
    public function __invoke(string $id): ArticleResource|JsonResponse
    {
        $result = ArticleApiService::restore($id);

        return $result instanceof Model ? new ArticleResource($result) : response()->json($result, 422);
    }
}
