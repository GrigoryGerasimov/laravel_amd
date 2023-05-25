<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Models\{Article, Brand, Color, Country, Season, Size};
use Illuminate\View\View;

final class EditController extends Controller
{
    public function __invoke(Article $article): View
    {
        $seasonsList = Season::all();
        $brandsList = Brand::all();
        $colorsList = Color::all();
        $sizesList = Size::all();
        $countriesList = Country::all();

        return view('articles.edit', compact('article', 'seasonsList', 'brandsList', 'colorsList', 'sizesList', 'countriesList'));
    }
}
