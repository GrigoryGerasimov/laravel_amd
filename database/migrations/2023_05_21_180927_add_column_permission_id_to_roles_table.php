<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->unsignedInteger('permission_id')->after('name')->unique();

            $table->index('permission_id', 'permission_idx');
            $table->foreign('permission_id', 'permission_fk')->references('id')->on('permissions');
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropForeign('permission_fk');
            $table->dropColumn('permission_id');
        });
    }
};
