<?php

namespace App\Enums;

/**
 * Enum 検索By 名前用の trait
 */
trait ValueOf
{
    /**
     * @return array 名前一覧へ
     */
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    /**
     * @param string $name 名前
     * @return ValueOf|null 名前に該当する自分
     */
    public static function valueOf(string $name): ?self
    {
        return collect(self::cases())->first(fn($e) => $e->name == $name);
    }
}
