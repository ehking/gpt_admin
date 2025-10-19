@extends('admin.layout')

@section('title', 'پنل‌ها')

@section('content')
    <header>
        <h1>مدیریت پنل‌ها</h1>
        <a href="{{ route('admin.panels.create') }}">افزودن پنل جدید</a>
    </header>
    <table>
        <thead>
            <tr>
                <th>نام</th>
                <th>شناسه</th>
                <th>تاریخ ایجاد</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($panels as $panel)
                <tr>
                    <td>{{ $panel->name }}</td>
                    <td>{{ $panel->slug }}</td>
                    <td>{{ $panel->created_at }}</td>
                    <td><a href="{{ route('admin.panels.show', $panel) }}">مدیریت</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $panels->links() }}
@endsection
