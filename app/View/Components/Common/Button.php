<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Button extends Component
{
    public function __construct(
        public string $styling,
        public string $category,
        public string $type = 'button',
        public bool $shouldDisableOnErrors = false
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.common.button');
    }
}
