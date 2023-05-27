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
        if (Schema::hasTable('players')) return;
        // 選手 テーブル 作成
        Schema::create('players', function (Blueprint $table) {
            // PK
            $table->id()->comment('選手ID');
            // フィールド
            $table->string('player_code')->unique()->comment('選手コード'); // TODO: PKにするか？
            $table->string('name')->comment('名前'); // レコードの違いを 分かりやすくするよう
            // deleted_at
            $table->softDeletes();
            // created_at, updated_at
            $table->timestamps();
            // テーブル名
            $table->comment('選手');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
