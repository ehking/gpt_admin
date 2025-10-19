@extends('admin.layout')

@section('title', 'ایجاد پنل')

@section('content')
    <h1>ایجاد پنل جدید</h1>
    <form method="POST" action="{{ route('admin.panels.store') }}">
        @csrf
        <label>نام
            <input type="text" name="name" value="{{ old('name') }}" required>
        </label>
        <label>شناسه (اختیاری)
            <input type="text" name="slug" value="{{ old('slug') }}">
        </label>
        <label>توضیحات
            <textarea name="description">{{ old('description') }}</textarea>
        </label>
        <label>اطلاعات اضافی (JSON)
            <textarea name="metadata">{{ old('metadata') }}</textarea>
        </label>
        <button type="submit">ایجاد</button>
    </form>
@endsection
