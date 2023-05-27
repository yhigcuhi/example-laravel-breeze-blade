<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 試合 サービス
 */
class GameService
{
    /* 利用リポジトリ */
    private SeasonSeriesService $seasonSeriesService; // シリーズサービス
    private SeasonSeriesGameService $seasonSeriesGameService; // シリーズ試合 サービス

    /**
     * コンストラクタ
     * @param SeasonSeriesService $seasonSeriesService
     * @param SeasonSeriesGameService $seasonSeriesGameService
     */
    public function __construct(SeasonSeriesService $seasonSeriesService, SeasonSeriesGameService $seasonSeriesGameService)
    {
        $this->seasonSeriesService = $seasonSeriesService;
        $this->seasonSeriesGameService = $seasonSeriesGameService;
    }

    /**
     * 指定検索条件、行数/ページ 分 の検索実行
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @param int $perPage 行数/ページ
     * @return LengthAwarePaginator ページネーション検索
     */
    public function search(array $conditions = [], int $perPage = 10): LengthAwarePaginator
    {
        // 該当のシリーズ検索
        $series = $this->seasonSeriesService->findBy($conditions);
        // シリーズコードの一覧化
        $seriesCodes = $series->map(fn($item) => $item->series_code);

        // 検索結果のシリーズ分を検索条件に追加し検索
        $conditionsOnSeriesCodes = collect($conditions)->merge(['series_code_in' => $seriesCodes->all()]); // 検索条件 追加 = シリーズコード in
        // 行数/ページ 分  検索実行
        return $this->seasonSeriesGameService->search($conditions, $perPage);
    }
}
