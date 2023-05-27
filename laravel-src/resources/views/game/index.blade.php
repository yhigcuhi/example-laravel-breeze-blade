<x-app-layout>
    <!-- ページ内でのヘッダー -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- 検索フォーム -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('game.partials.search-form')
            </div>
            <!-- 検索結果 -->
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                @include('game.partials.list')
            </div>
        </div>
    </div>
</x-app-layout>
