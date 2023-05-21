<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('role_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->timestamps();

            $table->index('role_id', 'role_permission_idx');
            $table->index('permission_id', 'permission_role_idx');

            $table->foreign('role_id', 'role_permission_fk')->references('id')->on('roles');
            $table->foreign('permission_id', 'permission_role_fk')->references('id')->on('permissions');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_permissions');
    }
};
