<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * シリーズ 試合出場選手 成績 モデル
 */
class SeasonSeriesGamePlayerTotalStats extends Model
{
    use HasFactory;
    use SoftDeletes;
    // モデルテーブル名
    protected $table = 'season_series_game_player_total_stats';
    // 登録更新できないフィールド
    protected $guarded = ['id'];
    // 登録更新する際に設定できる項目(カラム)
    protected $fillable = [
        'season_series_game_player_id', // 試合出場選手ID
        'total_point', // 最終ポイント = 着順ボーナス + (整数部4桁,少数部1桁)(1000点1ポイント)(±あり)
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
        'total_point' => 'float', // 小数点(整数部4桁,少数部1桁)
    ];
}
