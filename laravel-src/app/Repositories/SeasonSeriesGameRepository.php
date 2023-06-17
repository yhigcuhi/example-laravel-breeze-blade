<?php

namespace App\Repositories;

use App\Models\SeasonSeriesGame;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * (Mリーグ シーズン)シリーズ 試合 リポジトリ
 */
class SeasonSeriesGameRepository
{
    /**
     * 指定検索条件、一覧 検索実行
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @return Collection<SeasonSeriesGame> 一覧検索結果
     */
    public function findBy(array $conditions = []): Collection
    {
        // 検索条件生成
        $query = $this->buildQuery($conditions);
        // 指定ページ分だけ検索実行
        return $query->get();
    }

    /**
     * 指定検索条件、行数/ページ 分 の ページネーション検索
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @param int $perPage 行数/ページ
     * @return LengthAwarePaginator<SeasonSeriesGame> ページネーション検索
     */
    public function findPaginatorBy(array $conditions = [], int $perPage = 10): LengthAwarePaginator
    {
        // 検索条件生成
        $query = $this->buildQuery($conditions);
        // 指定 行数/ページ 分 の ページネーション検索
        return $query->paginate($perPage);
    }

    /**
     * ID 検索
     * @param int $id ID
     * @return SeasonSeriesGame|null 検索結果
     */
    public function findById(int $id): ?SeasonSeriesGame
    {
        return SeasonSeriesGame::with(['seasonSeriesGamePlayers'])->find($id)->first();
    }

    /**
     * 新規登録
     * @param array $inputs 入力値
     * @return SeasonSeriesGame 登録結果
     */
    public function create(array $inputs = []): SeasonSeriesGame
    {
        // 試合情報登録
        $result = new SeasonSeriesGame($inputs);
        $result->save(); // 登録実行
        // 結果返却
        return $result;
    }

    /**
     * 指定検索条件から 検索クエリ生成
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @return Builder 検索クエリ
     */
    private function buildQuery(array $conditions = []): Builder
    {
        // 検索条件 生成 = 初期値
        $builder = SeasonSeriesGame::with(['seasonSeriesGamePlayers']);
        if (empty($conditions)) return $builder; // 前提条件: 条件指定なし

        // 指定検索条件反映
        // シリーズコード指定
        if (isset($conditions['series_code'])) $builder = $builder->where('series_code', $conditions['series_code']); // 同一
        if (isset($conditions['series_code_in'])) $builder = $builder->whereIn('series_code', $conditions['series_code_in']); // 複数
        // 検索条件返却
        return $builder;
    }
}
