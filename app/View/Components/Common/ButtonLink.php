<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ButtonLink extends Component
{
    public function __construct(
        public string $styling,
        public string $category,
        public string $route
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.common.button-link');
    }
}
