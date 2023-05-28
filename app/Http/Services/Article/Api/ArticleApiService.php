<?php

declare(strict_types=1);

namespace App\Http\Services\Article\Api;

use App\Http\Services\Service;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\{DB, Log, Validator};
use Illuminate\Validation\Rule;

final class ArticleApiService extends Service
{
    protected static function handleException(\Exception $e): void
    {
        Log::error($e->getTraceAsString());

        echo $e->getMessage();
    }

    public static function store(FormRequest $request): Model
    {
        try {
            DB::beginTransaction();

            try {
                $article = Article::create(Validator::make($request->toArray(), [
                    'season_id' => 'required|integer',
                    'buying_article_sku' => 'required|string|min:4|max:13|unique:articles',
                    'buying_article_config' => 'required|string|min:4|max:13',
                    'brand_id' => 'required|integer',
                    'supplier_article_form' => 'required|string',
                    'supplier_article_number' => 'required|string',
                    'supplier_article_name' => 'required|string',
                    'color_id' => 'required|integer',
                    'size_id' => 'required|integer',
                    'ean_gtin' => 'required|string|max:13|unique:articles',
                    'country_id' => 'required|integer',
                    'hs_code' => 'required|string|min:4|max:13',
                    'user_id' => 'required|integer'
                ])->validated());

            } catch (\Exception $exception) {
                Log::alert('Article position not created');

                throw $exception;
            }

            DB::commit();

            return $article;
        } catch (\Exception $exception) {
            DB::rollback();

            self::handleException($exception);
            exit(1);
        }
    }

    public static function update(Model $model, FormRequest $request): Model
    {
        try {
            DB::beginTransaction();

            try {
                $model->update(Validator::make($request->toArray(), [
                    'season_id' => 'required|integer',
                    'buying_article_sku' => [
                        'required', 'string', 'min:4', 'max:13',
                        Rule::unique('articles')->ignore($request->route('article'))
                    ],
                    'buying_article_config' => 'required|string|min:4|max:13',
                    'brand_id' => 'required|integer',
                    'supplier_article_form' => 'required|string',
                    'supplier_article_number' => 'required|string',
                    'supplier_article_name' => 'required|string',
                    'color_id' => 'required|integer',
                    'size_id' => 'required|integer',
                    'ean_gtin' => [
                        'required', 'string', 'max:13',
                        Rule::unique('articles')->ignore($request->route('article'))
                    ],
                    'country_id' => 'required|integer',
                    'hs_code' => 'required|string|min:4|max:13',
                    'user_id' => 'required|integer'
                ])->validated());

            } catch (\Exception $exception) {
                Log::alert('Article position not updated');

                throw $exception;
            }

            DB::commit();

            return $model;
        } catch (\Exception $exception) {
            DB::rollback();

            self::handleException($exception);
            exit(1);
        }
    }

    public static function delete(Model $model): ?bool
    {
        try {
            DB::beginTransaction();

            try {
                $deleted = $model->delete();

            } catch (\Exception $exception) {
                Log::alert('Article position not deleted');

                throw $exception;
            }

            DB::commit();

            return $deleted;
        } catch (\Exception $exception) {
            DB::rollback();

            self::handleException($exception);
            exit(1);
        }
    }

    public static function restore(string $articleId): Article
    {
        try {
            DB::beginTransaction();

            try {
                $article = Article::withTrashed()->find($articleId);

                $article->restore();

            } catch (\Exception $exception) {
                Log::alert('Article position not restored');

                throw $exception;
            }

            DB::commit();

            return $article;
        } catch (\Exception $exception) {
            DB::rollback();

            self::handleException($exception);
            exit(1);
        }
    }
}
