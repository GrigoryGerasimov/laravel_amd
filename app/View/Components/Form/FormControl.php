<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Model;

final class FormControl extends Component
{
    public function __construct(
        public string $tAttr,
        public ?Model $unit = null,
        public ?string $title = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.form.form-control');
    }
}
