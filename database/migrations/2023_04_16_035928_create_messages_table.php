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
        Schema::create('messages', function (Blueprint $table) {
            $table->id()->comment('メッセージID');
            $table->foreignId('rooms_id')->comment('ルームID')->constrained();
            $table->foreignId('users_id')->comment('ユーザーID')->constrained();
            $table->string('message')->comment('メッセージ本文');
            $table->integer('del_fg')->comment('論理削除');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
