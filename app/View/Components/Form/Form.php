<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public function __construct(
        public string $route,
        public string $bladeMethod,
        public string $method = 'GET',
        public string $enctype = 'application/x-www-form-urlencoded'
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.form.form');
    }
}
