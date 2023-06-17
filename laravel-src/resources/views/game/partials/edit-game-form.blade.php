<section>
    <!-- セクション タイトル -->
    <header class="mb-2">
        <h2 class="text-lg font-medium text-gray-900">
            試合
        </h2>
    </header>
    <!-- 入力フォームカード -->
    <div class="col-12 my-4">
        <!-- フォーム: wrapper -->
        <div class="col-12 d-flex flex-wrap justify-between">
            <!-- フォーム：シーズン選択 -->
            <x-selects.select-season />
            <!-- フォーム：シリーズ -->
            <div class="col-12 mb-3">
                <x-labels.form-label for="series_category">シリーズ</x-labels.form-label>
                <!-- シリーズ の選択 -->
                <x-selects.select-series />
            </div>
            <!-- フォーム：試合日 -->
            <div class="col-12 mb-3">
                <x-labels.form-label for="game_day">試合日</x-labels.form-label>
                <!-- 試合日 の選択 -->
                <x-inputs.input-date id="game_day" name="game_day" />
            </div>
            <!-- フォーム：何試合目 -->
            <div class="col-12 mb-3">
                <x-labels.form-label for="how_many_games">何試合目</x-labels.form-label>
                <!-- 何試合目 の入力 -->
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="how_many_games" id="how_many_games1" value="1">
                        <label class="form-check-label" for="how_many_games1">1試合目</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="how_many_games" id="how_many_games2" value="2">
                        <label class="form-check-label" for="how_many_games2">2試合目</label>
                    </div>
                </div>
            </div>
            <!-- フォーム：ゲーム名 -->
            <div class="col-12 mb-3">
                <x-labels.form-label for="title">試合名</x-labels.form-label>
                <!-- ゲーム名の入力 -->
                <input id="title" type="text" name="title" class="form-control" placeholder="例：F-7　(ファイナルシリーズ 7試合目)" required/>
            </div>
        </div>
    </div>
</section>
