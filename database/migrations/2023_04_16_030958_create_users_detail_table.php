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
        Schema::create('users_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->comment('ユーザーID')->constrained();
            $table->integer('grade')->default(0)->comment('学年');
            $table->integer('class')->default(0)->comment('クラス');
            $table->string('onething', 50)->comment('ひとこと');
            $table->string('imgName')->comment('画像の名前');
            $table->string('imgPath')->comment('画像のパス');
            $table->string('tel')->comment('電話番号');
            $table->string('address', 50)->comment('住所');
            $table->string('emergency')->comment('緊急連絡先');
            $table->string('relationship')->comment('続柄');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_detail');
    }
};
