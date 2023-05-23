<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Services\ArticleService;
use Illuminate\Http\RedirectResponse;

final class StoreController extends Controller
{
    public function __invoke(ArticleRequest $request): RedirectResponse
    {
        $newArticle = ArticleService::store($request->validated());

        if (!$newArticle) {
            session()->flash('error_msg', 'Article position not created. Please try again');
            return redirect()->back();
        }

        return redirect(route('amd.index'), 201);
    }
}
