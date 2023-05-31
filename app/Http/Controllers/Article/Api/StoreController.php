<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Http\Services\Article\Api\ArticleApiService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

final class StoreController extends Controller
{
    public function __invoke(FormRequest $request): ArticleResource|JsonResponse
    {
        $result = ArticleApiService::store($request);

        return $result instanceof Model ? new ArticleResource($result) : response()->json($result, 422);
    }
}
