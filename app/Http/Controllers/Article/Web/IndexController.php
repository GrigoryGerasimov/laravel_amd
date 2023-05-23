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
        $articlesList = Article::all()->map(function (Article $item) {
            $item->season_id = Season::findOrFail($item->season_id)->name;
            $item->brand_id = Brand::findOrFail($item->brand_id)->name;
            $item->color_id = Color::findOrFail($item->color_id)->name;
            $item->size_id = Size::findOrFail($item->size_id)->code;
            return $item;
        });

        return view('articles.index', compact('articlesList'));
    }
}
