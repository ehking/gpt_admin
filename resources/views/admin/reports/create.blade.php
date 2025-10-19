@extends('admin.layout')

@section('title', 'گزارش جدید برای '.$panel->name)

@section('content')
    <h1>گزارش جدید برای {{ $panel->name }}</h1>
    <form method="POST" action="{{ route('admin.reports.store', $panel) }}">
        @csrf
        @include('admin.reports.partials.report-fields', ['report' => null])
        <button type="submit">ذخیره گزارش</button>
    </form>
@endsection
