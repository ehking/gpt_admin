@extends('admin.layout')

@section('title', 'افزودن منبع داده')

@section('content')
    <h1>افزودن منبع داده</h1>
    <form method="POST" action="{{ route('admin.data-sources.store') }}">
        @csrf
        @include('admin.data-sources.partials.form-fields', ['dataSource' => null])
        <button type="submit">ثبت</button>
    </form>
@endsection
