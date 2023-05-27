<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use Illuminate\View\View;
use Illuminate\Http\Request;

/**
 * 試合 コントローラー
 */
class GameController extends Controller
{
    /* 利用サービス */
    private GameService $gameService;

    /**
     * コンストラクタ
     * @param GameService $gameService
     */
    public function __construct(GameService $gameService)
    {
        $this->gameService = $gameService;
    }


    /**
     * 一覧画面
     * @param Request 表示通信
     * @return View 一覧画面
     */
    public function index(Request $request): View
    {
        // TODO:一旦シーズンをセッションにもつ 考えずに
        // 試合一覧 画面
        return view('game.index', [
            'user' => $request->user(),
            'games' => [],
        ]);
    }

    /**
     * 検索
     * @param Request 検索実行 リクエスト
     * @return View 一覧画面
     */
    public function search(Request $request): View
    {
        // 試合一覧 画面
        return view('game.index', [
            'user' => $request->user(),
            'games' => $this->gameService->search($request->all()),
        ]);
    }
}
