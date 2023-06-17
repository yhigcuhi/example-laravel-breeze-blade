@props([
    'classes' => '',
    'isNoBorder' => false,
    'isNoBorderFooter' => true,
    'bgFooter' => 'bg-white',
])
<div class="card {{ $classes }}" style="{{ $isNoBorder ? 'border: none;' : '' }}">
    <!-- カードボディ -->
    <div class="card-body">
        <!-- カード：メインコンテンツ -->
        {{ $slot }}
    </div>
    @if (isset($footer))
        <!-- カードフッター -->
        <div class="card-footer {{ $bgFooter }}" style="{{ $isNoBorder || $isNoBorderFooter ? 'border: none;' : '' }}">
            <div class="d-flex flex-wrap justify-end">
                <!-- カードフッター: slot -->
                {{ $footer }}
            </div>
        </div>
    @endif
</div>
