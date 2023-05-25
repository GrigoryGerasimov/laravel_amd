<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class TableHeader extends Component
{
    public function __construct(
        public array $columns
    ) {}

    public function shouldRender(): bool
    {
        return count($this->columns) !== 0;
    }

    public function render(): View|Closure|string
    {
        return view('components.table.table-header');
    }
}
