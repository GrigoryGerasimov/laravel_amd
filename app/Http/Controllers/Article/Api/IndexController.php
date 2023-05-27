<?php

namespace App\Http\Controllers\Article\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleResource;
use App\Models\Article;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $articlesList = Article::all()->sort();

        return ArticleResource::collection($articlesList);
    }
}
