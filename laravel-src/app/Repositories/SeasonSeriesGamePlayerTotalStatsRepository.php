<?php

namespace App\Repositories;

use App\Models\SeasonSeriesGame;
use App\Models\SeasonSeriesGamePlayer;
use App\Models\SeasonSeriesGamePlayerTotalStats;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * (Mリーグ シーズン)シリーズ 試合出場選手 成績 リポジトリ
 */
class SeasonSeriesGamePlayerTotalStatsRepository
{
    /**
     * 新規登録
     * @param array $inputs 入力値
     * @return SeasonSeriesGamePlayerTotalStats 登録結果
     */
    public function create(array $inputs = []): SeasonSeriesGamePlayerTotalStats
    {
        // 試合情報登録
        $result = new SeasonSeriesGamePlayerTotalStats($inputs);
        $result->save(); // 登録実行
        // 結果返却
        return $result;
    }
}
