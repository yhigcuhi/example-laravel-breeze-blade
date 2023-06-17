<?php

namespace App\Services;

use App\Models\Player;
use App\Repositories\PlayerRepository;
use Illuminate\Support\Collection;

/**
 * 選手 サービス
 */
class PlayerService
{
    /* 利用リポジトリ */
    private PlayerRepository $repository; // TODO:シーズンの選手ではなく 選手として検索

    /**
     * @param PlayerRepository $repository
     */
    public function __construct(PlayerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return Collection<Player> 一覧取得
     */
    public function getAll(): Collection
    {
        return $this->findBy();
    }

    /**
     * 一覧検索
     * @param array $conditions
     * @return Collection<Player>
     */
    public function findBy(array $conditions = []): Collection
    {
        // TODO:セッションのシーズンから シーズンを補完して検索するなどは また別で
        return $this->repository->findBy($conditions);
    }
}
