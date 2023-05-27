<?php

use App\Enums\Direction;
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
        if (Schema::hasTable('season_series_game_players')) return;
        // それ以外 テーブル作成
        Schema::create('season_series_game_players', function (Blueprint $table) {
            // PK
            $table->id()->comment('試合出場選手ID');
            // フィールド
            $table->bigInteger('season_series_game_id')->comment('試合ID');
            $table->string('player_code')->comment('(出場)選手コード');
            $table->enum('direction', collect(Direction::cases())->map(fn($e) => $e->name)->all())->comment('席順(東家など)の風');
            // deleted_at
            $table->softDeletes();
            // created_at, updated_at
            $table->timestamps();
            // テーブル名
            $table->comment('シリーズ 試合出場選手');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_series_game_players');
    }
};
