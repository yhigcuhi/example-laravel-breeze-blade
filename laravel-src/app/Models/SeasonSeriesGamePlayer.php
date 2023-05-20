<?php

namespace App\Models;

use App\Enums\Direction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * シリーズ 試合出場選手 モデル
 */
class SeasonSeriesGamePlayer extends Model
{
    use HasFactory;
    // 登録更新できないフィールド
    protected $guarded = ['id'];
    // 登録更新する際に設定できる項目(カラム)
    protected $fillable = [
        'season_series_game_id', // 試合ID
        'player_code', // (出場)選手コード
        'direction', // 席順(東家など)の風
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
        'direction' => Direction::class,
    ];
    // with
    protected $with = [
        // 'player',
        'seasonSeriesGamePlayerTotalStat',
    ];

    /** リレーション */
    /**
     * 選手(TODO:シーズンとしての選手で紐付ける 最終的には)
     * @return HasOne|null 選手
     */
    public function player(): ?HasOne
    {
        return $this->hasOne(Player::class, 'player_code', 'player_code');
    }

    /**
     * シリーズ 試合出場選手 成績
     * @return HasOne|null 試合出場選手 成績
     */
    public function seasonSeriesGamePlayerTotalStat(): ?HasOne
    {
        return $this->hasOne(SeasonSeriesGamePlayerTotalStats::class, 'season_series_game_player_id');
    }
}
