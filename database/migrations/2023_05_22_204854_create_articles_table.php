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
            $table->string('buying_article_sku')->nullable(false)->unique();
            $table->string('buying_article_config')->nullable(false)->unique();
            $table->string('brand_name')->nullable(false)->unique();
            $table->unsignedBigInteger('supplier_article_number')->nullable(false);
            $table->string('supplier_article_name')->nullable(false);
            $table->unsignedBigInteger('supplier_color_code')->nullable(false);
            $table->string('supplier_color_name')->nullable(false);
            $table->tinyText('supplier_size')->nullable(false);
            $table->char('EAN/GTIN', 13)->nullable(false);
            $table->string('country_of_origin');
            $table->string('textile_outer_material');
            $table->unsignedInteger('user_id')->nullable(false);
            $table->timestamps();
            $table->softDeletes()->nullable();

            $table->index('user_id', 'user_id_idx');
            $table->foreign('user_id', 'user_id_fk')->references('id')->on('users');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function(Blueprint $table) {
            $table->dropIndex('user_id_idx');
            $table->dropForeign('user_id_fk');
        });
        Schema::dropIfExists('articles');
    }
};
