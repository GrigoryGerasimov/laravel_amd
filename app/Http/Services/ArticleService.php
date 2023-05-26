<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Models\Article;
use Illuminate\Support\Facades\{DB, Log};
use Illuminate\Http\RedirectResponse;

final class ArticleService
{
    public static function store(array $validatedRequest): Article|RedirectResponse
    {
        try {
            DB::beginTransaction();

            try {
                $article = Article::create($validatedRequest);

                session()->flash('success_msg', 'Article position successfully created');
            } catch (\Exception $e) {
                Log::alert('Article position not created');

                throw $e;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
            session()->flash('error_msg', 'Data not saved due to technical issue. Please try again');
            return redirect()->back();
        }

        return $article;
    }

    public static function update(Article $article, array $validatedRequest): Article|RedirectResponse
    {
        try {
            DB::beginTransaction();

            try {
                $article->update($validatedRequest);

                session()->flash('success_msg', 'Article position successfully updated');
            } catch (\Exception $e) {
                Log::alert('Article position not updated');

                throw $e;
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
            session()->flash('error_msg', 'Data not updated due to technical issue. Please try again');
            return redirect()->back();
        }

        return $article;
    }
}
