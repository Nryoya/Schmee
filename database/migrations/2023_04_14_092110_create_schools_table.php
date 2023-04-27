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
        Schema::create('schools', function (Blueprint $table) {
            $table->id()->unique()->comment('学校ID');
            $table->string('code', 50)->unique()->comment('学校コード');
            $table->string('name', 50)->unique()->comment('学校名');
            $table->string('address', 50)->unique()->comment('学校住所');
            $table->string('tel')->unique()->comment('学校電話番号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
