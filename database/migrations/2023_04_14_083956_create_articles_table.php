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
        Schema::create('articles', function (Blueprint $table) {
            $table->id()->unique()->comment('学校通信ID');
            $table->string('title', 100)->comment('タイトル');
            $table->string('body')->comment('本文');
            $table->string('imgName')->comment('画像の名前');
            $table->string('imgPath')->comment('画像のパス');
            $table->foreignId('schools_id')->comment('学校ID')->constrained();
            $table->foreignId('users_id')->comment('ユーザーID')->constrained();
            $table->integer('grade')->default(0)->comment('学年');
            $table->integer('class')->default(0)->comment('クラス');
            $table->integer('del_fg')->default(0)->comment('0:表示 1:非表示');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
