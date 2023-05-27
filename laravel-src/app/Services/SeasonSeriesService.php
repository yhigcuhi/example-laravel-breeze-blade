<?php

namespace App\Services;

use App\Enums\SeriesCategory;
use App\Models\SeasonSeries;
use App\Repositories\SeasonSeriesRepository;
use Illuminate\Support\Collection;

/**
 * (Mリーグ シーズン)シリーズ サービス
 */
class SeasonSeriesService
{
    /* 利用リポジトリ */
    private SeasonSeriesRepository $repository;

    /**
     * コンストラクタ
     * @param SeasonSeriesRepository $repository
     */
    public function __construct(SeasonSeriesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 指定検索条件 の一覧検索実行
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @return Collection<SeasonSeries> 検索結果
     */
    public function findBy(array $conditions = []): Collection
    {
        // 検索実行
        return $this->repository->findBy($conditions);
    }

    /**
     * ユニーク 1件 検索
     * @param string $seasonCode シーズン
     * @param string $seriesCategory シリーズカテゴリ
     * @return SeasonSeries|null 検索結果
     */
    public function findByUnique(string $seasonCode, SeriesCategory $seriesCategory): ?SeasonSeries
    {
        // 検索実行
        return $this->repository->findByUnique($seasonCode, $seriesCategory->name);
    }
}
