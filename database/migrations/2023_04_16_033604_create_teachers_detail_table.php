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
        Schema::create('teachers_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->comment('ユーザーID')->constrained()->cascadeOnDelete();
            $table->string('jobs', 50)->comment('役職');
            $table->integer('grade')->default(0)->comment('学年');
            $table->integer('class')->default(0)->comment('クラス');
            $table->string('imgPath')->default('img/user.qng')->comment('画像のパス');
            $table->string('introduction')->comment('自己紹介');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers_detail');
    }
};
