<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
            $table->timestamps();

            $table->index('user_id', 'user_role_idx');
            $table->index('role_id', 'role_user_idx');

            $table->foreign('user_id', 'user_role_fk')->references('id')->on('users');
            $table->foreign('role_id', 'role_user_fk')->references('id')->on('roles');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
