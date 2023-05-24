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
        $article->season_id = Season::find($article->season_id)->name;
        $article->brand_id = Brand::find($article->brand_id)->name;
        $article->color_id = Color::find($article->color_id)->name;
        $article->size_id = Size::find($article->size_id)->code;
        $article->country_id = Country::find($article->country_id)->name;
        $article->user_id = User::find($article->user_id)->name;

        return view('articles.show', ['article' => $article]);
    }
}
