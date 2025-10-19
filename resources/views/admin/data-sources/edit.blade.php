@extends('admin.layout')

@section('title', 'ویرایش '.$dataSource->name)

@section('content')
    <h1>ویرایش {{ $dataSource->name }}</h1>
    <form method="POST" action="{{ route('admin.data-sources.update', $dataSource) }}">
        @csrf
        @method('PUT')
        @include('admin.data-sources.partials.form-fields', ['dataSource' => $dataSource])
        <button type="submit">به‌روزرسانی</button>
    </form>
    <form method="POST" action="{{ route('admin.data-sources.destroy', $dataSource) }}">
        @csrf
        @method('DELETE')
        <button type="submit">حذف</button>
    </form>
@endsection
