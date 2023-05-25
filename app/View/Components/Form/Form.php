<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class Form extends Component
{
    public function __construct(
        public Collection $seasonsList,
        public Collection $brandsList,
        public Collection $colorsList,
        public Collection $sizesList,
        public Collection $countriesList,
        public string $route,
        public string $enctype = 'application/x-www-form-urlencoded'
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.form.form');
    }
}
