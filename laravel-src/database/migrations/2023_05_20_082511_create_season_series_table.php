<?php

use App\Enums\SeriesCategory;
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
        if (Schema::hasTable('season_series')) return;
        // それ以外 テーブル 作成
        Schema::create('season_series', function (Blueprint $table) {
            // PK
            $table->id()->comment('シリーズID');
            // フィールド
            $table->string('season_code')->comment('(FK)シーズンコード');
            $table->string('series_code')->unique()->comment('シリーズコード'); // TODO:PKにする？ (2022-23-REGULAR:(2022-23シーズン)Mリーグ レギュラーシーズン の意味)
            $table->enum('series_category', collect(SeriesCategory::cases())->map(fn($e) => $e->name)->all())->comment('シリーズ カテゴリー');
            $table->date('start_day')->nullable()->comment('シリーズ 期間 開始日'); // 決まっていない:null
            $table->date('end_day')->nullable()->comment('シリーズ 期間 終了日'); // 決まっていない:null
            // created_at, updated_at
            $table->timestamps();
            // テーブル名
            $table->comment('(Mリーグ シーズン)シリーズ');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('season_series');
    }
};
