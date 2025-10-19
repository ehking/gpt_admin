@extends('admin.layout')

@section('title', 'پیش‌نمایش گزارش '.$report->name)

@section('content')
    <h1>پیش‌نمایش گزارش {{ $report->name }}</h1>
    <pre>{{ json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endsection
