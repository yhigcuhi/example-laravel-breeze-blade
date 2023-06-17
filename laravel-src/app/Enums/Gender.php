<?php

namespace App\Enums;

/**
 * PHP8.1から Enum利用
 * 性別
 */
enum Gender
{
    use ValueOf;
    // 定義
    case MEN;
    case WOMEN;

    /**
     * @return {string} 画面表示名
     */
    public function label(): string
    {
        return match($this) {
            static::MEN => '男性',
            static::WOMEN => '女性',
        };
    }
}
