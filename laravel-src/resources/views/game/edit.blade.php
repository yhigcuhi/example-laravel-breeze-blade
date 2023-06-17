<x-app-layout>
    <!-- ページ内でのヘッダー -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            試合登録
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <form action="{{ route('game.store') }}" method="post">
                @csrf
                <!-- 登録フォーム: 試合情報 -->
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    @include('game.partials.edit-game-form')
                </div>
                <!-- 登録フォーム: 出場選手 -->
                <div class="mt-4 p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    @include('game.partials.edit-game-players-form', ['players' => $players])
                    <!-- 登録フォーム: メニュー -->
                    <div class="col-12 my-4">
                        <div class="d-flex flex-wrap justify-end">
                            <x-buttons.button-save />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
