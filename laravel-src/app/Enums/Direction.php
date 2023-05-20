<?php

namespace App\Enums;

/**
 * PHP8.1から Enum利用
 * 東南西北
 */
enum Direction
{
    case EAST;
    case SOUTH;
    case WEST;
    case NORTH;
    /**
     * @return {string} 画面表示名
     */
    public function label(): string
    {
        return match($this) {
            static::EAST => '東',
            static::SOUTH => '南',
            static::WEST => '西',
            static::NORTH => '北',
        };
    }
}
