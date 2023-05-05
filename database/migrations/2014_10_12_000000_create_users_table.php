<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->unique()->comment('ユーザーID');
            $table->string('name', 50)->comment('ユーザーネーム');
            $table->string('email', 50)->unique()->comment('メールアドレス');
            $table->string('password')->comment('パスワード');
            $table->foreignId('schools_id')->comment('学校ID')->constrained()->cascadeOnDelete();
            $table->rememberToken()->comment('トークン');
            $table->integer('role')->default(0)->comment('0:保護者 1:関係者 2:代表者 3:運営者');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
