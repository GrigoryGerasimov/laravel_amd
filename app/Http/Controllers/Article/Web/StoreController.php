<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\Web\ArticleWebStoreRequest;
use App\Http\Services\Article\Web\ArticleWebService;
use Illuminate\Http\RedirectResponse;

final class StoreController extends Controller
{
    public function __invoke(ArticleWebStoreRequest $request): RedirectResponse
    {
        ArticleWebService::store($request->validated());

        return redirect(route('amd.index'), 201);
    }
}
