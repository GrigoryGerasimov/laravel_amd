<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableBody extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.table.table-body');
    }
}
