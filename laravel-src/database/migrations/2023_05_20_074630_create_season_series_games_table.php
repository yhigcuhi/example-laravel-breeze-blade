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
        if (Schema::hasTable('season_series_games')) return;
        // それ以外 テーブル作成
        Schema::create('season_series_games', function (Blueprint $table) {
            // PK
            $table->id()->comment('シリーズ 試合ID');
            // フィールド
            $table->string('series_code')->comment('シリーズコード');
            $table->string('game_code')->unique()->comment('試合コード'); // TODO:PKにする?
            $table->string('title')->comment('試合 画面表示名');
            $table->date('game_day')->comment('試合日');
            $table->integer('how_many_games')->comment('何試合目');
            // deleted_at
            $table->softDeletes();
            // created_at, updated_at
            $table->timestamps();
            // テーブル名
            $table->comment('シリーズ 試合');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_series_games');
    }
};
