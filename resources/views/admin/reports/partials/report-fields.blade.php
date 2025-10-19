@php
    $query = old('query', optional($report)->query ?? []);
    $visualization = old('visualization', optional($report)->visualization ?? []);
    $mapping = old('mappings', optional($report)->dataSources?->mapWithKeys(fn($source) => [$source->id => $source->pivot->mapping])->toArray() ?? []);
@endphp

<label>نام
    <input type="text" name="name" value="{{ old('name', optional($report)->name) }}" required>
</label>
<label>شناسه
    <input type="text" name="slug" value="{{ old('slug', optional($report)->slug) }}">
</label>
<label>توضیحات
    <textarea name="description">{{ old('description', optional($report)->description) }}</textarea>
</label>
<label>پیکربندی Query (JSON)
    <textarea name="query">{{ old('query', json_encode($query, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
</label>
<label>تنظیمات نمایش (JSON)
    <textarea name="visualization">{{ old('visualization', json_encode($visualization, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
</label>
<label>منابع داده
    <select name="data_sources[]" multiple>
        @foreach($dataSources as $source)
            <option value="{{ $source->id }}" @selected(collect(old('data_sources', optional($report)->dataSources?->pluck('id')))->contains($source->id))>
                {{ $source->name }} ({{ $source->driver }})
            </option>
        @endforeach
    </select>
</label>
@foreach($dataSources as $source)
    <label>نگاشت فیلدها برای {{ $source->name }}
        <textarea name="mappings[{{ $source->id }}]">{{ $mapping[$source->id] ?? '' }}</textarea>
    </label>
@endforeach
