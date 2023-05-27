<section>
    <!-- セクション タイトル -->
    <header class="mb-2">
        <h2 class="text-lg font-medium text-gray-900">
            検索フォーム
        </h2>
    </header>
    <!-- 検索フォームカード -->
    <form method="post" action="{{ route('game.search') }}" class="mt-6 space-y-6 form-group">
        @csrf
        <x-card classes="col-12">
            <!-- フォーム: wrapper -->
            <div class="col-12 d-flex flex-wrap justify-between">
                <!-- フォーム：シーズン選択 -->
                <x-selects.select-season />
                <!-- フォーム：シリーズ -->
                <div class="col-6 mb-3 pe-2">
                    <x-labels.form-label for="series_category">シリーズ</x-labels.form-label>
                    <!-- シリーズ の選択 -->
                    <x-selects.select-series />
                </div>
                <!-- フォーム：試合日 -->
                <div class="col-6 mb-3 pe-2">
                    <x-labels.form-label for="game_day">試合日</x-labels.form-label>
                    <!-- 試合日 の選択 -->
                    <x-inputs.input-date id="game_day" name="game_day" />
                </div>
            </div>
            <!-- フォーム: メニュー -->
            @slot('footer')
            <div class="col-6 justify-between btn-group">
                <x-buttons.button-clear classes="me-4" />
                <x-buttons.button-search/>
            </div>
            @endslot
        </x-card>
    </form>
</section>
