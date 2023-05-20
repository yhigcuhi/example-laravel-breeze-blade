<?php

namespace App\Enums;

/**
 * PHP8.1から Enum利用
 * (Mリーグ シーズン)シリーズ カテゴリー
 */
enum SeriesCategory
{
    case REGULAR;
    case SEMI_FINAL;
    case FINAL;
    /**
     * @return {string} 画面表示名
     */
    public function label(): string
    {
        return match($this) {
            static::REGULAR => 'レギュラーシーズン',
            static::SEMI_FINAL => 'セミファイナルシリーズ',
            static::FINAL => 'ファイナルシリーズ',
        };
    }
}
