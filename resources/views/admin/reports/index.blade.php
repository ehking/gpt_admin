@extends('admin.layout')

@section('title', 'گزارش‌های '.$panel->name)

@section('content')
    <header>
        <h1>گزارش‌های {{ $panel->name }}</h1>
        <a href="{{ route('admin.panels.reports.create', $panel) }}">گزارش جدید</a>
    </header>
    <table>
        <thead>
            <tr>
                <th>نام</th>
                <th>شناسه</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->name }}</td>
                    <td>{{ $report->slug }}</td>
                    <td><a href="{{ route('admin.panels.reports.edit', [$panel, $report]) }}">ویرایش</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $reports->links() }}
@endsection
