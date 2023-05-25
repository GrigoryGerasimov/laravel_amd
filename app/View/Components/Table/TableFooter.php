<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class TableFooter extends Component
{
    public function __construct() {}

    public function render(): View|Closure|string
    {
        return view('components.table.table-footer');
    }
}
