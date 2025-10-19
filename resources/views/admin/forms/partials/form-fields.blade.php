@php
    $schema = old('schema', optional($form)->schema ?? []);
    $mapping = old('mappings', optional($form)->dataSources?->mapWithKeys(fn($source) => [$source->id => $source->pivot->mapping])->toArray() ?? []);
@endphp

<label>نام
    <input type="text" name="name" value="{{ old('name', optional($form)->name) }}" required>
</label>
<label>شناسه
    <input type="text" name="slug" value="{{ old('slug', optional($form)->slug) }}">
</label>
<label>توضیحات
    <textarea name="description">{{ old('description', optional($form)->description) }}</textarea>
</label>
<label>ساختار فرم (JSON)
    <textarea name="schema">{{ old('schema', json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
</label>
<label>آدرس ثبت (اختیاری)
    <input type="url" name="submit_handler" value="{{ old('submit_handler', optional($form)->submit_handler) }}">
</label>
<label>منابع داده
    <select name="data_sources[]" multiple>
        @foreach($dataSources as $source)
            <option value="{{ $source->id }}" @selected(collect(old('data_sources', optional($form)->dataSources?->pluck('id')))->contains($source->id))>
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
