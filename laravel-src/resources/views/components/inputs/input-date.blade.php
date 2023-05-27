@props([
    'id' => '',
    'name' => '',
    'classes' => '',
    'rounded' => true
])
<!-- 日付入力 -->
<input id="{{ $id }}" type="date" name="{{ $name }}" class="form-control {{ $rounded ? 'rounded' : '' }} {{ $classes }}"/>