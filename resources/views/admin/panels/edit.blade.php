@extends('admin.layout')

@section('title', 'ویرایش '.$panel->name)

@section('content')
    <h1>ویرایش {{ $panel->name }}</h1>
    <form method="POST" action="{{ route('admin.panels.update', $panel) }}">
        @csrf
        @method('PUT')
        <label>نام
            <input type="text" name="name" value="{{ old('name', $panel->name) }}" required>
        </label>
        <label>شناسه
            <input type="text" name="slug" value="{{ old('slug', $panel->slug) }}">
        </label>
        <label>توضیحات
            <textarea name="description">{{ old('description', $panel->description) }}</textarea>
        </label>
        <label>اطلاعات اضافی (JSON)
            <textarea name="metadata">{{ old('metadata', json_encode($panel->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) }}</textarea>
        </label>
        <button type="submit">ذخیره</button>
    </form>
@endsection
