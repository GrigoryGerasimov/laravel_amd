<?php

namespace App\View\Components\Table;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

final class Table extends Component
{
    public function __construct(
        public string $addClasses
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.table.table');
    }
}
