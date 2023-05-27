@props([
    'for' => '',
    'classes' => '',
])
<!-- Formのラベル -->
<label for="{{ $for }}" class="form-label  {{ $classes }}">{{$slot}}</label>