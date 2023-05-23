<?php

declare(strict_types=1);

namespace App\Http\Controllers\Article\Web;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

final class CreateController extends Controller
{
    public function __invoke(): View
    {
        return view('articles.create');
    }
}
