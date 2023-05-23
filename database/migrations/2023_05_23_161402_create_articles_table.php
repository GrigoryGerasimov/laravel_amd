<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('season_id')->nullable(false);
            $table->char('buying_article_sku', 13)->nullable(false)->unique();
            $table->char('buying_article_config', 13)->nullable(false);
            $table->unsignedInteger('brand_id')->nullable(false);
            $table->char('supplier_article_form', 4)->nullable(false);
            $table->char('supplier_article_number', 5)->nullable(false);
            $table->string('supplier_article_name')->nullable(false);
            $table->unsignedInteger('color_id')->nullable(false);
            $table->unsignedInteger('size_id')->nullable(false);
            $table->char('ean_gtin', 13)->nullable(false)->unique();
            $table->unsignedInteger('country_id')->nullable(false);
            $table->char('hs_code', 13)->nullable(false);
            $table->unsignedInteger('user_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->index(['season_id', 'brand_id', 'color_id', 'size_id', 'country_id', 'user_id'], 'amd_idx');

            $table->foreign('season_id', 'season_id_fk')->references('id')->on('seasons');
            $table->foreign('brand_id', 'brand_id_fk')->references('id')->on('brands');
            $table->foreign('color_id', 'color_id_fk')->references('id')->on('colors');
            $table->foreign('size_id', 'size_id_fk')->references('id')->on('sizes');
            $table->foreign('country_id', 'country_id_fk')->references('id')->on('countries');
            $table->foreign('user_id', 'user_id_fk')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function(Blueprint $table) {
            $table->dropIndex('amd_idx');
            $table->dropForeign('season_id_fk');
            $table->dropForeign('brand_id_fk');
            $table->dropForeign('color_id_fk');
            $table->dropForeign('size_id_fk');
            $table->dropForeign('country_id_fk');
            $table->dropForeign('user_id_fk');
        });
        Schema::dropIfExists('articles');
    }
};
