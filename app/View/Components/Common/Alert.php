<?php

namespace App\View\Components\Common;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

final class Alert extends Component
{
    public function __construct(
        public string $type,
        public string $message
    ) {}

    public function shouldRender(): bool
    {
        return Session::has($this->message);
    }

    public function render(): View|Closure|string
    {
        return view('components.common.alert');
    }
}
