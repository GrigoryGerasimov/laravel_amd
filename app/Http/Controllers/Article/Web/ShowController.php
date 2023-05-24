<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Models\{Article, Season, Brand, Color, Size, Country, User};
use Illuminate\View\View;

final class ShowController extends Controller
{
    public function __invoke(Article $article): View
    {
        return view('articles.show', compact('article'));
    }
}
