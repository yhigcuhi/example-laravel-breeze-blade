<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * (Mリーグ シーズン)シリーズ 試合 モデル
 */
class SeasonSeriesGame extends Model
{
    use HasFactory;
    use SoftDeletes;
    // モデルテーブル名
    protected $table = 'season_series_games';
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
        'seasonSeriesGamePlayers',
    ];
    // シリアライズに追加する項目
    protected $appends = ['game_day_md'];

    /**
     * @return void 独自 起動時の処理
     */
    protected static function boot()
    {
        // super
        parent::boot();

        // 独自 登録前処理
        self::creating(function ($model) {
            // 登録前処理 補完
            // 試合日
            $game_day = CarbonImmutable::parse($model->game_day)->format('Ymd');
            // 試合コード = シリーズコード + - + 試合日(Ymd) + - + 何試合目 + A(一旦固定) 例:2022-23-REGULAR-20221003-1A:(2022-23シーズン)Mリーグ 2022/10/03 1試合目 Aコートの意味
            $model->game_code = "$model->series_code-$game_day-$model->how_many_games-A";

            // 結果
            return $model;
        });
    }

    /** リレーション */
    /**
     * シリーズ 試合出場選手 一覧
     * @return HasMany 試合出場選手 一覧
     */
    public function seasonSeriesGamePlayers(): HasMany
    {
        return $this->hasMany(SeasonSeriesGamePlayer::class, 'season_series_game_id');
    }

    /**
     * @return string 試合日の m月d日形式
     */
    public function getGameDayMdAttribute(): string
    {
        return CarbonImmutable::parse($this->game_day)->format('m月d日');
    }
}
