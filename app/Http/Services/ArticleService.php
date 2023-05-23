<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Article;
use Illuminate\Support\Facades\{DB, Log};

final class ArticleService
{
    public static function store(array $validatedRequest): ?Article
    {
        try {
            DB::beginTransaction();

            $article = Article::create($validatedRequest);

            DB::commit();

            session()->flash('success_msg', 'Article position successfully created');
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
            session()->flash('error_msg', 'Data not saved due to technical issue. Please try again');
        }

        return $article;
    }

    public static function update()
    {

    }
}
