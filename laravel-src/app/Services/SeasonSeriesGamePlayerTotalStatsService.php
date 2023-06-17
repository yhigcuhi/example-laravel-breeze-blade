<?php

namespace App\Services;

use App\Models\SeasonSeriesGamePlayerTotalStats;
use App\Repositories\SeasonSeriesGamePlayerTotalStatsRepository;

/**
 * (Mリーグ シーズン)シリーズ 試合出場選手 成績 サービス
 */
class SeasonSeriesGamePlayerTotalStatsService
{
    /* 利用リポジトリ */
    private SeasonSeriesGamePlayerTotalStatsRepository $repository;

    /**
     * コンストラクタ
     * @param SeasonSeriesGamePlayerTotalStatsRepository $repository
     */
    public function __construct(SeasonSeriesGamePlayerTotalStatsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 新規登録 実行
     * @param array $inputs 登録値
     * @return SeasonSeriesGamePlayerTotalStats 登録結果
     */
    public function create(array $inputs = []): SeasonSeriesGamePlayerTotalStats
    {
        return $this->repository->create($inputs);
    }
}
