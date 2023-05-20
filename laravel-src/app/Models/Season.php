<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Mリーグ シーズン定義マスタ
 */
class Season extends Model
{
    use HasFactory;
    // 登録更新できないフィールド
    protected $guarded = ['id'];
    // 登録更新する際に設定できる項目(カラム)
    protected $fillable = [
        'season_code', // TODO: PKか？
        'title', // 画面表示名
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
    // with
    protected $with = [
        'seasonSeries',
    ];

    /** リレーション */
    /**
     * シリーズ 一覧
     * @return HasMany シリーズ 一覧
     */
    public function seasonSeries(): HasMany
    {
        return $this->hasMany(SeasonSeries::class, 'season_code', 'season_code');
    }
}
