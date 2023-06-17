<?php

namespace App\Services;

use App\Models\SeasonSeriesGame;
use App\Models\SeasonSeriesGamePlayer;
use App\Repositories\SeasonSeriesGamePlayerRepository;
use App\Repositories\SeasonSeriesGameRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * (Mリーグ シーズン)シリーズ 試合出場選手 サービス
 */
class SeasonSeriesGamePlayerService
{
    /* 利用リポジトリ */
    private SeasonSeriesGamePlayerRepository $repository;

    /**
     * コンストラクタ
     * @param SeasonSeriesGamePlayerRepository $repository
     */
    public function __construct(SeasonSeriesGamePlayerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 新規登録 実行
     * @param array $inputs 登録値
     * @return SeasonSeriesGamePlayer 登録結果
     */
    public function create(array $inputs = []): SeasonSeriesGamePlayer
    {
        return $this->repository->create($inputs);
    }
}
