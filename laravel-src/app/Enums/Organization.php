<?php

namespace App\Enums;

/**
 * PHP8.1から Enum利用
 * 麻雀競技 プロ団体
 */
enum Organization
{
    case JPML; //日本プロ麻雀連盟
    case NPM; //日本プロ麻雀協会
    case SAIKOUISEN; //最高位戦日本プロ麻雀協会
    case MJU; //麻将連合-μ-
    case RMU; //RMU

    /**
     * @return {string} 画面表示名
     */
    public function label(): string
    {
        return match($this) {
            static::JPML => '日本プロ麻雀連盟',
            static::NPM => '日本プロ麻雀協会',
            static::SAIKOUISEN => '最高位戦日本プロ麻雀協会',
            static::MJU => '麻将連合-μ-',
            static::RMU => 'RMU',
        };
    }
}
