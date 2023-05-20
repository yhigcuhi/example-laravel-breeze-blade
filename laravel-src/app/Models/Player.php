<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * 選手(Mリーガー)マスタ
 */
class Player extends Model
{
    use HasFactory;
    // 登録更新できないフィールド
    protected $guarded = ['id'];
    // 登録更新する際に設定できる項目(カラム)
    protected $fillable = [
        'player_code', // TODO: PKか？
        'name', // 名前:レコードの違いを 分かりやすくするよう
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
    // リレーション先のデータ
    protected $with = [
        'playerProfile'
    ];
    /**
     * 選手プロフィール
     * @return HasOne
     */
    public function playerProfile(): HasOne
    {
        return $this->hasOne(PlayerProfile::class, 'player_code', 'player_code');
    }
}
