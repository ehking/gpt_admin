<label>نام
    <input type="text" name="name" value="{{ old('name', optional($dataSource)->name) }}" required>
</label>
<label>درایور
    <select name="driver" required>
        @php $drivers = ['http' => 'HTTP API', 'internal' => 'درخواست داخلی']; @endphp
        @foreach($drivers as $value => $label)
            <option value="{{ $value }}" @selected(old('driver', optional($dataSource)->driver) === $value)>{{ $label }}</option>
        @endforeach
    </select>
</label>
<label>پیکربندی (JSON)
    <textarea name="configuration">{{ old('configuration', json_encode(optional($dataSource)->configuration ?? [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
</label>
