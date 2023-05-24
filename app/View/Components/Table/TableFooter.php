<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class TableFooter extends Component
{
    public function __construct(
        public bool $isDetailed
    ) {}

    public function shouldRender(): bool
    {
        return Gate::allows('create');
    }

    public function render(): View|Closure|string
    {
        return view('components.table.table-footer');
    }
}
