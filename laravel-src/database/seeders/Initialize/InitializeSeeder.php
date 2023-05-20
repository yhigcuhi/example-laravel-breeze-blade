<?php

namespace Database\Seeders\Initialize;

use Illuminate\Database\Seeder;

/**
 * 初期化 Seeder 集約
 */
class InitializeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // プロジェクト マストの初期化 マスタだけを呼び出す (全ての環境)
        $this->call([
            SeasonSeeder::class, // Mリーグ シーズン 定義
            PlayerSeeder::class, // 選手定義
        ]);
    }
}
