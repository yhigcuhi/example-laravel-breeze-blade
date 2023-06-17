<?php

namespace App\Services;

use App\Enums\SeriesCategory;
use App\Models\Player;
use App\Models\SeasonSeries;
use App\Models\SeasonSeriesGame;
use App\Models\SeasonSeriesGamePlayer;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * 試合 サービス
 */
class GameService
{
    /* 利用リポジトリ */
    private SeasonSeriesService $seasonSeriesService; // シリーズサービス
    private SeasonSeriesGameService $seasonSeriesGameService; // シリーズ試合 サービス
    private SeasonSeriesGamePlayerService $seasonSeriesGamePlayerService; // シリーズ試合出場選手 サービス
    private SeasonSeriesGamePlayerTotalStatsService $seasonSeriesGamePlayerTotalStatsService; // シリーズ試合出場選手 成績 サービス

    /**
     * @param SeasonSeriesService $seasonSeriesService
     * @param SeasonSeriesGameService $seasonSeriesGameService
     * @param SeasonSeriesGamePlayerService $seasonSeriesGamePlayerService
     * @param SeasonSeriesGamePlayerTotalStatsService $seasonSeriesGamePlayerTotalStatsService
     */
    public function __construct(SeasonSeriesService $seasonSeriesService, SeasonSeriesGameService $seasonSeriesGameService, SeasonSeriesGamePlayerService $seasonSeriesGamePlayerService, SeasonSeriesGamePlayerTotalStatsService $seasonSeriesGamePlayerTotalStatsService)
    {
        $this->seasonSeriesService = $seasonSeriesService;
        $this->seasonSeriesGameService = $seasonSeriesGameService;
        $this->seasonSeriesGamePlayerService = $seasonSeriesGamePlayerService;
        $this->seasonSeriesGamePlayerTotalStatsService = $seasonSeriesGamePlayerTotalStatsService;
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
        return $this->seasonSeriesGameService->search($conditionsOnSeriesCodes->all(), $perPage);
    }

    /**
     * 新規登録
     * @param array $gameInputs 登録 試合 入力値
     * @param array $gamePlayerInputs 登録 試合出場選手 入力値
     * @return SeasonSeriesGame|null 登録結果 (nullなし)
     */
    public function create(array $gameInputs = [], array $gamePlayerInputs = []): ?SeasonSeriesGame
    {
        // 前提条件
        if (empty($gameInputs)) return null;
        if (empty($gamePlayerInputs)) return null;

        // 入力値 補完
        $seriesCode = $gameInputs['series_code'] ?: $this->findSeriesCodeBySeason($gameInputs['season_code'], $gameInputs['series_category']);

        // 試合情報登録
        $game = $this->seasonSeriesGameService->create([...$gameInputs, 'series_code' => $seriesCode]);
        // 風ごとに 出場選手登録
        collect($gamePlayerInputs)->each(fn ($player, $direction) => $this->saveSeasonSeriesGamePlayer([...$gamePlayerInputs, 'season_series_game_id' => $game, 'direction' => $direction]));

        // 最新化された 試合情報で返却
        return $this->seasonSeriesGameService->findById($game->id);
    }

    /**
     * シリーズコード検索
     * @param string|null $seasonCode
     * @param SeriesCategory|string|null $seriesCategory
     * @return string|null
     */
    private function findSeriesCodeBySeason(string $seasonCode = null, SeriesCategory|string $seriesCategory = null): ?string
    {
        // 前提条件
        if (!$seasonCode) return null;
        if (!$seriesCategory) return null;
        // シリーズ検索
        return SeasonSeries::query()->where('season_code', $seasonCode)->where('series_category', $seriesCategory)->first()?->series_code;
    }

    /**
     * 試合出場選手 保存
     * @param array $gamePlayerInputs 保存入力値(total_pointを指定したら そちらも保存)
     * @return SeasonSeriesGamePlayer 保存結果
     */
    private function saveSeasonSeriesGamePlayer(array $gamePlayerInputs = []): SeasonSeriesGamePlayer
    {
        // 補完
        $total_point = $gamePlayerInputs['total_point'];
        // 試合出場選手の登録
        $gamePlayer = $this->seasonSeriesGamePlayerService->create($gamePlayerInputs);

        // 試合出場選手の成績 登録
        if (!is_null($total_point)) {
            $gamePlayer->season_series_game_player_total_stats = $this->seasonSeriesGamePlayerTotalStatsService->create(['season_series_game_player_id' => $gamePlayer->id, 'total_point' => $total_point]);
        }
        // 結果返却
        return $gamePlayer;
    }
}
