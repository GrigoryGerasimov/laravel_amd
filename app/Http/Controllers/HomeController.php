<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

final class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('home');
    }

    public function showProtected(): View
    {
        return view('protected');
    }
}
