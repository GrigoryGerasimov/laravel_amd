<?php

declare(strict_types=1);

namespace App\Http\Services;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Support\Facades\{DB, Log};

final class ArticleService
{
    public static function store(array $validatedRequest)
    {
        try {
            DB::beginTransaction();

            $article = Article::create($validatedRequest);

            if (!$article) {
                redirect()->back();
                session()->flash('error_msg', 'Article position not created. Please try again');
            }

            DB::commit();

            session()->flash('success_msg', 'Article position successfully created');
        } catch (\Exception $e) {
            DB::rollback();

            Log::error($e->getMessage());
            session()->flash('error_msg', 'Data not saved due to technical issue. Please try again');
        }
    }

    public static function update()
    {

    }
}
