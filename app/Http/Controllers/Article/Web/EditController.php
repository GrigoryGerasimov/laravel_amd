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
        $seasonsList = Season::all()->sort();
        $brandsList = Brand::all()->sort();
        $colorsList = Color::all()->sort();
        $sizesList = Size::all()->sort();
        $countriesList = Country::all()->sort();

        return view('articles.edit', compact('article', 'seasonsList', 'brandsList', 'colorsList', 'sizesList', 'countriesList'));
    }
}
