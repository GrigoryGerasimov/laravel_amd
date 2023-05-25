<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class FormControl extends Component
{
    public function __construct(
        public string $tAttr,
        public ?string $title = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.form.form-control');
    }
}
