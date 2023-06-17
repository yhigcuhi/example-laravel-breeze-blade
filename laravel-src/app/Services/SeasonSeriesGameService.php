<?php

namespace App\Services;

use App\Models\SeasonSeriesGame;
use App\Repositories\SeasonSeriesGameRepository;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * (Mリーグ シーズン)シリーズ 試合 サービス
 */
class SeasonSeriesGameService
{
    /* 利用リポジトリ */
    private SeasonSeriesGameRepository $repository;

    /**
     * コンストラクタ
     * @param SeasonSeriesGameRepository $repository
     */
    public function __construct(SeasonSeriesGameRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * 指定検索条件、行数/ページ 分 の ページネーション検索
     * @param array<string, mixed>|null $conditions 検索条件(連想配列) TODO:将来的には ValueObjectでの表現へ
     * @param int $perPage 行数/ページ
     * @return LengthAwarePaginator ページネーション検索
     */
    public function search(array $conditions = [], int $perPage = 10): LengthAwarePaginator
    {
        // 検索実行
        return $this->repository->findPaginatorBy($conditions, $perPage);
    }

    public function findById(?int $id): ?SeasonSeriesGame
    {
        // 前提条件
        if (!$id) return null;
        // ID検索
        return $this->repository->findById($id);
    }

    /**
     * 新規登録 実行
     * @param array $inputs 登録値
     * @return SeasonSeriesGame 登録結果
     */
    public function create(array $inputs = []): SeasonSeriesGame
    {
        return $this->repository->create($inputs);
    }
}
