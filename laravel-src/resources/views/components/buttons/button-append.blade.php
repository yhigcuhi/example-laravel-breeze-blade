@props([
    'classes' => '',
    'route' => '',
    'parameters' => [], // ルートのパラメーター
])
<!-- 追加ボタン -->
<a href="{{ $route ? route($route, $parameters) : 'javascript:void(0);' }}" class="btn btn-success border rounded {{ $classes }}" {{ $attributes->merge(['class' => 'btn']) }}>+ 新規追加</a>
