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
        $seasonsList = Season::all();
        $brandsList = Brand::all();
        $colorsList = Color::all();
        $sizesList = Size::all();
        $countriesList = Country::all();

        return view('articles.create', compact('seasonsList', 'brandsList', 'colorsList', 'sizesList', 'countriesList'));
    }
}
