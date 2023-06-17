<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameStoreRequest;
use App\Services\GameService;
use App\Services\PlayerService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\Request;

/**
 * 試合 コントローラー
 */
class GameController extends Controller
{
    // trait
    use SelectedSeason; // シーズン選択

    /* 利用サービス */
    private GameService $gameService; // 試合サービス
    private PlayerService $playerService; // 選手サービス

    /**
     * コンストラクタ
     * @param GameService $gameService
     * @param PlayerService $playerService
     */
    public function __construct(GameService $gameService, PlayerService $playerService)
    {
        $this->gameService = $gameService;
        $this->playerService = $playerService;
    }


    /**
     * 一覧画面 表示
     * @return View 一覧画面
     */
    public function index(): View
    {
        // 試合一覧 画面
        return view('game.index', [
            // 画面表示引数
            'games' => null,
        ]);
    }

    /**
     * 検索 実行
     * @param Request 検索実行 リクエスト
     * @return View 一覧画面
     */
    public function search(Request $request): View
    {
        // 選択済みシーズン更新
        $this->selectSeasonCode($request->input('season_code'));

        // 試合一覧 画面 検索結果反映
        return view('game.index', [
            // 画面表示引数
            'games' => $this->gameService->search($request->all()),
        ]);
    }

    /**
     * 新規登録 画面表示
     * @return View
     */
    public function create(): View
    {
        // 試合 新規登録 画面表示
        return view('game.edit', [
            // 画面表示引数
            'players' => $this->playerService->getAll(), // 選手一覧
        ]);
    }

    /**
     * 追加
     * @param GameStoreRequest $request 保存内容
     * @return RedirectResponse 結果画面
     */
    public function store(GameStoreRequest $request): RedirectResponse
    {
        try {
            // トランザクション開始
            DB::beginTransaction();

            // 入力値 補完
            $gameInputs = $request->all(); // 登録試合情報
            $gamePlayerInputs = $request->input('players');  // 風ごとの 試合出場選手 一覧 {東家:{選手, 結果}, ...}

            // 登録実行
            $game = $this->gameService->create($gameInputs, $gamePlayerInputs);

            // コミット
            DB::commit();
            // 登録後の 画面へ
            return redirect()->route('game.show', ['id' => $game->id]);
        } catch (Exception $e) {
            // ログ出力
            Log::error($e->getMessage());
            // ロールバック
            DB::rollBack();
            // サーバーエラー
            abort(500);
        }
    }
}
