<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * シリーズ 試合 モデル
 */
class SeasonSeriesGame extends Model
{
    use HasFactory;
    // 登録更新できないフィールド
    protected $guarded = ['id'];
    // 登録更新する際に設定できる項目(カラム)
    protected $fillable = [
        'series_code', // シリーズコード
        'game_code', // 試合コード
        'title', // 試合 画面表示名
        'game_day', // 試合日
        'how_many_games', // 何試合目
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
        'game_day' => 'immutable_datetime:Y-m-d',
    ];
    // with
    protected $with = [
        // 'series',
        'seasonSeriesGamePlayers',
    ];

    /** リレーション */
    /**
     * シリーズ 試合出場選手 一覧
     * @return HasMany 試合出場選手 一覧
     */
    public function seasonSeriesGamePlayers(): HasMany
    {
        return $this->hasMany(SeasonSeriesGamePlayer::class, 'season_series_game_id');
    }
}
