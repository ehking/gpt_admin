@extends('admin.layout')

@section('title', $panel->name)

@section('content')
    <header>
        <h1>{{ $panel->name }}</h1>
        <a href="{{ route('admin.panels.edit', $panel) }}">ویرایش</a>
    </header>
    <p>{{ $panel->description }}</p>
    <pre>{{ json_encode($panel->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>

    <section>
        <h2>کاربران پنل</h2>
        <a href="{{ route('admin.panels.users.index', $panel) }}">مدیریت کاربران</a>
    </section>

    <section>
        <h2>فرم‌ها</h2>
        <a href="{{ route('admin.forms.index', $panel) }}">مدیریت فرم‌ها</a>
    </section>

    <section>
        <h2>گزارش‌ها</h2>
        <a href="{{ route('admin.reports.index', $panel) }}">مدیریت گزارش‌ها</a>
    </section>
@endsection
