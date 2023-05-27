<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use App\Models\{Season, Brand, Color, Size, Country};
use Illuminate\View\View;

final class CreateController extends Controller
{
    public function __invoke(): View
    {
        $seasonsList = Season::all()->sort();
        $brandsList = Brand::all()->sort();
        $colorsList = Color::all()->sort();
        $sizesList = Size::all()->sort();
        $countriesList = Country::all()->sort();

        return view('articles.create', compact('seasonsList', 'brandsList', 'colorsList', 'sizesList', 'countriesList'));
    }
}
