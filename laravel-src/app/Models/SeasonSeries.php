<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * (Mリーグ シーズン)シリーズ モデル
 */
class SeasonSeries extends Model
{
    use HasFactory;
    use SoftDeletes;
    // モデルテーブル名
    protected $table = 'season_series';
    // 登録更新できないフィールド
    protected $guarded = ['id'];
    // 登録更新する際に設定できる項目(カラム)
    protected $fillable = [
        'season_code', // (FK)シーズンコード
        'series_code', // シリーズコード
        'series_category', // シリーズ カテゴリー
        'start_day', // シリーズ 期間 開始日
        'end_day', // シリーズ 期間 終了日
    ];
    // Carbon インスタンスとして扱うところ
    protected $dates = [
        'created_at',
        'updated_at',
    ];
    // シリアライズさせないところ
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    // キャスト
    protected $casts = [
        'start_day' => 'immutable_datetime:Y-m-d',
        'end_day' => 'immutable_datetime:Y-m-d',
    ];
    // with
    protected $with = [
        'seasonSeriesGames',
    ];

    /** リレーション */
    /**
     * シリーズ 試合 一覧
     * @return HasMany シリーズ 試合 一覧
     */
    public function seasonSeriesGames(): HasMany
    {
        return $this->hasMany(SeasonSeriesGame::class, 'series_code', 'series_code');
    }
}
