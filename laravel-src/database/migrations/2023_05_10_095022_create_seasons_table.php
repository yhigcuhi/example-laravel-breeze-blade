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
        // テーブルが存在していれば 何もしない
        if (Schema::hasTable('seasons')) return;
        // Mリーグ シーズン テーブル 作成
        Schema::create('seasons', function (Blueprint $table) {
            // PK
            $table->id()->comment('Mリーグ シーズンID');
            // フィールド
            $table->string('season_code')->unique()->comment('シーズンコード'); // TODO: PKにするか？
            $table->string('title')->comment('画面表示名');
            // deleted_at
            $table->softDeletes();
            // created_at, updated_at
            $table->timestamps();
            // テーブル名
            $table->comment('Mリーグ シーズン');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
