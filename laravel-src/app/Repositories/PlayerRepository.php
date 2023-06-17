<?php

namespace App\Repositories;

use App\Models\Player;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * 選手 リポジトリ
 */
class PlayerRepository
{
    /**
     * 指定検索条件、一覧 検索実行
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @return Collection<Player> 一覧検索結果
     */
    public function findBy(array $conditions = []): Collection
    {
        // 検索条件生成
        $query = $this->buildQuery($conditions);
        // 指定ページ分だけ検索実行
        return $query->get();
    }

    /**
     * 指定検索条件から 検索クエリ生成
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @return Builder 検索クエリ
     */
    private function buildQuery(array $conditions = []): Builder
    {
        // 検索条件 生成 = 初期値
        $builder = Player::with(['playerProfile']);
        if (empty($conditions)) return $builder; // 前提条件: 条件指定なし

        // 指定検索条件反映
        // 選手コード指定
        if (isset($conditions['player_code'])) $builder = $builder->where('player_code', $conditions['player_code']); // 同一
        // 選手名
        if (isset($conditions['name'])) $builder = $builder->where('name', $conditions['name']);; // 同一
        if (isset($conditions['name_partial'])) $builder = $builder->where('name', 'LIKE', '%'.$conditions['name_partial'].'%');; // 部分一致
        // 検索条件返却
        return $builder;
    }
}
