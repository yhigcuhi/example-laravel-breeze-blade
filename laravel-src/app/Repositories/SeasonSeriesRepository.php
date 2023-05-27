<?php

namespace App\Repositories;

use App\Enums\SeriesCategory;
use App\Models\SeasonSeries;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * (Mリーグ シーズン)シリーズ リポジトリ
 */
class SeasonSeriesRepository
{
    /**
     * 指定検索条件、一覧 検索実行
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @return Collection<SeasonSeries> 一覧検索結果
     */
    public function findBy(array $conditions = []): Collection
    {
        // 検索条件生成
        $query = $this->buildQuery($conditions);
        // 指定ページ分だけ検索実行
        return $query->get();
    }

    /**
     * ユニーク 1件 検索
     * @param string $seasonCode シーズン
     * @param string $seriesCategory シリーズカテゴリ
     * @return SeasonSeries|null 検索結果
     */
    public function findByUnique(string $seasonCode, string $seriesCategory): ?SeasonSeries
    {
        return SeasonSeries::where('season_code', $seasonCode)->where('series_category', $seriesCategory)->first();
    }

    /**
     * 指定検索条件から 検索クエリ生成
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @return Builder 検索クエリ
     */
    private function buildQuery(array $conditions = []): Builder
    {
        // 検索条件 生成 = 初期値
        $builder = SeasonSeries::query();
        if (empty($conditions)) return $builder; // 前提条件: 条件指定なし

        // 指定検索条件反映
        // シーズン指定
        if (isset($conditions['season_code'])) $builder = $builder->where('season_code', $conditions['season_code']);
        // シリーズカテゴリ指定
        if (isset($conditions['series_category'])) $builder = $builder->where('series_category', $conditions['series_category']);
        // 検索条件返却
        return $builder;
    }
}
