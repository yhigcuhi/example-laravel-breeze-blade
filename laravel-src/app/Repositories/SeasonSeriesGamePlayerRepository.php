<?php

namespace App\Repositories;

use App\Models\SeasonSeriesGame;
use App\Models\SeasonSeriesGamePlayer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * (Mリーグ シーズン)シリーズ 試合出場選手 リポジトリ
 */
class SeasonSeriesGamePlayerRepository
{
    /**
     * 新規登録
     * @param array $inputs 入力値
     * @return SeasonSeriesGamePlayer 登録結果
     */
    public function create(array $inputs = []): SeasonSeriesGamePlayer
    {
        // 試合情報登録
        $result = new SeasonSeriesGamePlayer($inputs);
        $result->save(); // 登録実行
        // 結果返却
        return $result;
    }
}
