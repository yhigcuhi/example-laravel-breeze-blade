<?php

namespace App\Http\Controllers;

/**
 * 選択済み シーズン利用 トレイト
 */
trait SelectedSeason
{
    /**
     * 選択済み セッション シーズンコード 取得
     * @return string|null セッション シーズンコード
     */
    public function selectedSeasonCode(): ?string
    {
        return session('season_code');
    }

    /**
     * セッション シーズン更新(選択済みへ)
     * @param string|null $season_code 更新値
     */
    public function selectSeasonCode(string|null $season_code): void
    {
        session(['season_code' => $season_code]);
    }

    public function clearSelectedSeasonCode(): void
    {
        $this->selectSeasonCode(null);
    }
}
