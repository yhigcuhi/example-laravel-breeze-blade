<?php

namespace App\Http\Requests;

use App\Enums\Direction;
use App\Enums\SeriesCategory;
use App\Models\SeasonSeriesGame;
use Illuminate\Validation\Rules\Enum;

/**
 * 試合情報保存リクエスト
 */
class GameStoreRequest extends SeasonRequest
{
    /**
     * バリデーション前処理
     */
    protected function prepareForValidation()
    {
        // 補完
        $this->merge([
            'season_code' => $this->getSeasonCode(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'season_code' => ['required', 'exists:season_series,season_code'], // シーズンコード = シリーズに存在
            'series_category' => ['required', new Enum(SeriesCategory::class)], // シリーズカテゴリ
            'title' => ['required'],
            'game_day' => ['required', 'date'],
            'how_many_games' => ['required', 'integer'],
            'players.*.player_code' => ['required', 'exists:players,player_code'], // 選手コード
            'players.*.direction' => ['required', new Enum(Direction::class)], // 席順(東家など)の風
            'players.*.total_point' => ['required', 'numeric'], // 最終ポイント
        ];
    }
}
