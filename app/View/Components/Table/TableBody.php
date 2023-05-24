<?php

namespace App\View\Components\Table;

use App\Models\Article;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Database\Eloquent\Collection;

class TableBody extends Component
{
    public function __construct(
        public Collection $articlesList,
        public Article $article,
        public bool $isDetailed
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.table.table-body');
    }
}
