<section>
    <!-- セクション タイトル -->
    <header class="mb-2">
        <h2 class="text-lg font-medium text-gray-900">
            出場選手
        </h2>
    </header>
    <!-- 入力フォームカード -->
    <div class="col-12 my-4">
        <!-- フォーム: wrapper -->
        <div class="col-12 d-flex flex-wrap justify-between">
            <!-- 風ごとの出場選手 -->
            @foreach(Direction::cases() as $direction)
                <div class="d-flex flex-wrap col-3 px-3">
                    <!-- フォーム：出場選手 -->
                    <div class="col-12 mb-3">
                        <x-labels.form-label for="series_category">{{ $direction->label() }}家</x-labels.form-label>
                        <input type="hidden" name="{{"players[{$direction->name}][direction]"}}" value="{{ $direction->name }}">
                        <select name="{{"players[{$direction->name}][player_code]"}}" class="form-select" required>
                            @foreach ($players as $player)
                                <option @if(isset($current_player) && $player->id == $current_player->id) selected @endif value="{{ $player->player_code }}">{{ $player->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- フォーム：総ポイント -->
                    <div class="col-12">
                        <!-- 試合日 の選択 -->
                        <input id="total_point" type="number" name="{{"players[{$direction->name}][total_point]"}}" class="form-control" placeholder="総ポイント：59.2など" step="0.1" required/>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
