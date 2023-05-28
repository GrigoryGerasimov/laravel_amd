<?php

declare(strict_types=1);

namespace App\Http\Services;

abstract class Service implements ServiceInterface
{
    abstract protected static function handleException(\Exception $e);
}
