<?php

declare(strict_types=1);

namespace App\Http\Services\Article\Web;

use App\Http\Services\Service;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\{DB, Log};

final class ArticleWebService extends Service
{
    protected static function handleException(\Exception $e): RedirectResponse
    {
        Log::error($e->getMessage());

        session()->flash('error_msg', 'Data not saved due to technical issue. Please try again');

        return redirect()->back();
    }

    public static function store(FormRequest $request): Model|RedirectResponse
    {
        try {
            DB::beginTransaction();

            try {
                $article = Article::create($request->validated());

                session()->flash('success_msg', 'Article position successfully created');
            } catch (\Exception $exception) {
                Log::alert('Article position not created');

                throw $exception;
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            return self::handleException($exception);
        }

        return $article;
    }

    public static function update(Model $model, FormRequest $request): Model|RedirectResponse
    {
        try {
            DB::beginTransaction();

            try {
                $model->update($request->validated());

                session()->flash('success_msg', 'Article position successfully updated');
            } catch (\Exception $exception) {
                Log::alert('Article position not updated');

                throw $exception;
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            return self::handleException($exception);
        }

        return $model;
    }

    public static function delete(Model $model): bool|null|RedirectResponse
    {
        try {
            DB::beginTransaction();

            try {
                $deleted = $model->delete();

                session()->flash('success_msg', 'Article position successfully deleted');
            } catch (\Exception $exception) {
                Log::alert('Article position not deleted');

                throw $exception;
            }

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();

            return self::handleException($exception);
        }

        return $deleted;
    }
}
