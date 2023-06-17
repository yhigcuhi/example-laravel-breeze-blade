<section>
    <!-- セクション タイトル -->
    <header class="mb-2">
        <h2 class="text-lg font-medium text-gray-900">
            Mリーグ 試合
        </h2>
    </header>
    <!-- 一覧 -->
    <div class="col-12 mt-4">
        <!-- 一覧: メニュー -->
        <div class="my-2 d-flex flex-wrap justify-end">
            <div class="col-2 justify-between btn-group">
                <x-buttons.button-append route="game.create"/>
            </div>
        </div>
        <!-- 一覧: 表 -->
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">試合</th>
                    @foreach(Direction::cases() as $direction)
                        <th scope="col">{{ $direction->label() }}家</th>
                    @endforeach
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @if(!is_null($games))
                    @if(!empty($games))
                        @foreach($games as $game)
                            <tr>
                                <th scope="row">
                                    {{ $game->game_day_md }}<br/>
                                    {{ $game->title }}
                                </th>
                                @foreach(Direction::cases() as $direction)
                                    @php
                                        // 東南西北ごとの表示
                                        // 出場選手を 東南西北の形へ
                                        $playerByDirection = $game->seasonSeriesGamePlayers->keyBy(fn($item) => $item->direction->name);
                                        // 表示する 東南西北 いずれかの選手
                                        $directionPlayer = $playerByDirection[$direction->name];
                                        // 外だし
                                        $playerName = $directionPlayer?->player->name; // 選手名
                                        $totalPointOfGame = $directionPlayer?->seasonSeriesGamePlayerTotalStats->total_point; // 試合結果 獲得 総ポイント
                                    @endphp
                                    <td>
                                        {{ $playerName }}<br/>
                                        <span class=" {{ $totalPointOfGame < 0 ? 'text-danger' : ''}}">
                                            {{ $totalPointOfGame }}
                                        </span>
                                    </td>
                                @endforeach
                                <td>
                                    <button class="btn btn-outline-dark">→ 詳細</button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                該当する結果が見つかりませんでした
                            </td>
                        </tr>
                    @endif
                @endif
            </tbody>
        </table>
    </div>
</section>
