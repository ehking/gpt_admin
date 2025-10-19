@extends('admin.layout')

@section('title', 'ویرایش گزارش '.$report->name)

@section('content')
    <h1>ویرایش گزارش {{ $report->name }}</h1>
    <form method="POST" action="{{ route('admin.reports.update', [$panel, $report]) }}">
        @csrf
        @method('PUT')
        @include('admin.reports.partials.report-fields', ['report' => $report])
        <button type="submit">به‌روزرسانی گزارش</button>
    </form>
    <form method="POST" action="{{ route('admin.reports.preview', [$panel, $report]) }}">
        @csrf
        <button type="submit">پیش‌نمایش گزارش</button>
    </form>
@endsection
