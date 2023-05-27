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
        if (Schema::hasTable('season_series_game_player_total_stats')) return;
        // それ以外 テーブル作成
        Schema::create('season_series_game_player_total_stats', function (Blueprint $table) {
            // PK
            $table->id()->comment('試合出場選手 成績ID');
            // フィールド
            $table->bigInteger('season_series_game_player_id')->comment('試合出場選手ID');
            $table->float('total_point', 5, 1)->comment('最終ポイント'); // ドメイン = 着順ボーナス + (整数部4桁,少数部1桁)(1000点1ポイント)(±あり)
            // TODO:細かいところは省く
            // deleted_at
            $table->softDeletes();
            // created_at, updated_at
            $table->timestamps();
            // テーブル名
            $table->comment('シリーズ 試合出場選手 成績');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_series_game_player_total_stats');
    }
};
