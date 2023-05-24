<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Models\{Article, Season, Brand, Color, Size};
use Illuminate\View\View;

final class IndexController extends Controller
{
    public function __invoke(): View
    {
        $articlesList = Article::all();

        return view('articles.index', compact('articlesList'));
    }
}
