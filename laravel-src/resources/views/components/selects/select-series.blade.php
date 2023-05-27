@props([
    'id' => 'series_category',
    'classes' => '',
])
<!-- シリーズ の選択 -->
<select id="{{ $id }}" name="series_category" class="form-select {{ $classes }}">
    @foreach (SeriesCategory::cases() as $category)
    <option value="{{ $category->name }}">{{ $category->label() }}</option>
    @endforeach
</select>
