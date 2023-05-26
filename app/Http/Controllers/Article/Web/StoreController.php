<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\ArticleStoreRequest;
use App\Http\Services\ArticleService;
use Illuminate\Http\RedirectResponse;

final class StoreController extends Controller
{
    public function __invoke(ArticleStoreRequest $request): RedirectResponse
    {
        ArticleService::store($request->validated());

        return redirect(route('amd.index'), 201);
    }
}
