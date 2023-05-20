<?php

namespace Database\Seeders\Initialize;

use App\Enums\Direction;
use App\Enums\SeriesCategory;
use App\Models\Season;
use App\Models\SeasonSeries;
use App\Models\SeasonSeriesGame;
use App\Models\SeasonSeriesGamePlayer;
use App\Models\SeasonSeriesGamePlayerTotalStats;
use Illuminate\Database\Seeder;

/**
 * Mリーグシーズン シーダー
 */
class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TRUNCATE
        Season::truncate();
        SeasonSeries::truncate();
        // 初期値設定
        Season::insert($this->seasonValues());
        SeasonSeries::insert($this->seasonSeriesValues());

        // ローカル用のサンプル
        if (app()->isLocal()) {
            // 試合情報の設定 (ゴールとなるサンプル用)
            SeasonSeriesGame::truncate();
            SeasonSeriesGamePlayer::truncate();
            SeasonSeriesGamePlayerTotalStats::truncate();
            // 初期値設定
            SeasonSeriesGame::insert($this->seasonSeriesGameValues());
            SeasonSeriesGamePlayer::insert($this->seasonSeriesGamePlayerValues());
            SeasonSeriesGamePlayerTotalStats::insert($this->seasonSeriesGamePlayerTotalStatsValues());
        }
    }

    /**
     * @return array 初期値
     */
    private function seasonValues(): array
    {
        return [
            [
                'season_code' => '2022-23',
                'title' => '2022-23 シーズン',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    }

    /**
     * @return array 初期値
     */
    private function seasonSeriesValues(): array
    {
        return [
            [
                'season_code' => '2022-23',
                'series_code' => '2022-23-'.SeriesCategory::REGULAR->name, // (2022-23シーズン)Mリーグ レギュラーシーズン の意味
                'series_category' => SeriesCategory::REGULAR->name, // レギュラー シーズン
                'start_day' => '2022-10-03',
                'end_day' => '2023-03-21',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_code' => '2022-23',
                'series_code' => '2022-23-'.SeriesCategory::SEMI_FINAL->name,
                'series_category' => SeriesCategory::SEMI_FINAL->name,
                'start_day' => '2023-04-10',
                'end_day' => '2023-05-04',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_code' => '2022-23',
                'series_code' => '2022-23-'.SeriesCategory::FINAL->name,
                'series_category' => SeriesCategory::FINAL->name,
                'start_day' => '2023-05-08',
                'end_day' => '2023-05-19',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    }

    /**
     * @return array 初期値
     */
    private function seasonSeriesGameValues(): array
    {
        return [
            [
                'series_code' => '2022-23-'.SeriesCategory::FINAL->name,
                'game_code' => '2022-23-'.SeriesCategory::FINAL->name.'-20230512-01A', // 試合コード
                'title' => 'F-7', // 試合 画面表示名
                'game_day' => '2023-05-12', // 試合日
                'how_many_games' => 1, // 第1試合
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'series_code' => '2022-23-'.SeriesCategory::FINAL->name,
                'game_code' => '2022-23-'.SeriesCategory::FINAL->name.'-20230512-02A', // 試合コード
                'title' => 'F-8', // 試合 画面表示名
                'game_day' => '2023-05-12', // 試合日
                'how_many_games' => 2, // 第1試合
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    }

    /**
     * @return array 初期値
     */
    private function seasonSeriesGamePlayerValues(): array
    {
        return [
            // 第1試合
            [
                'season_series_game_id' => 1, // 試合ID
                'player_code' => 'MATUGASETAKAYA', // (出場)選手コード
                'direction' => Direction::EAST->name, // 東
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_id' => 1,
                'player_code' => 'SASAKIHISATO',
                'direction' => Direction::SOUTH->name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_id' => 1,
                'player_code' => 'SHIRATORISHO',
                'direction' => Direction::WEST->name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_id' => 1,
                'player_code' => 'KUROSAWASAKI',
                'direction' => Direction::NORTH->name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 第2試合
            [
                'season_series_game_id' => 2, // 試合ID
                'player_code' => 'DATEARISA', // (出場)選手コード
                'direction' => Direction::EAST->name, // 東
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_id' => 2,
                'player_code' => 'NIKAIDOAKI',
                'direction' => Direction::SOUTH->name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_id' => 2,
                'player_code' => 'HONDATOMOHIRO',
                'direction' => Direction::WEST->name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_id' => 2,
                'player_code' => 'MATUMOTOYOSIHIRO',
                'direction' => Direction::NORTH->name,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    }
    /**
     * @return array 初期値
     */
    private function seasonSeriesGamePlayerTotalStatsValues(): array
    {
        return [
            // 第1試合
            [
                'season_series_game_player_id' => 1, // 試合出場選手ID
                'total_point' => '-55.1', // 最終ポイント
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_player_id' => 2,
                'total_point' => '59.2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_player_id' => 3,
                'total_point' => '12.1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_player_id' => 4,
                'total_point' => '-16.2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // 第2試合
            [
                'season_series_game_player_id' => 5,
                'total_point' => '-7.7',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_player_id' => 6,
                'total_point' => '-78.2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_player_id' => 7,
                'total_point' => '73.0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'season_series_game_player_id' => 8,
                'total_point' => '12.9',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
    }
}
