<?php

declare(strict_types=1);

namespace App\Http\Services;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    public static function store(FormRequest $request);

    public static function update(Model $model, FormRequest $request);

    public static function delete(Model $model);
}
