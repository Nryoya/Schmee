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
        Schema::create('comments', function (Blueprint $table) {
            $table->id()->comment('コメントID');
            $table->foreignId('articles_id')->comment('学校通信ID')->constrained()->cascadeOnDelete();
            $table->foreignId('users_id')->comment('ユーザーID')->constrained()->cascadeOnDelete();
            $table->string('body')->comment('コメント本文');
            $table->integer('del_fg')->comment('0:表示 1:非表示');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
