@extends('admin.layout')

@section('title', 'فرم جدید برای '.$panel->name)

@section('content')
    <h1>فرم جدید برای {{ $panel->name }}</h1>
    <form method="POST" action="{{ route('admin.forms.store', $panel) }}">
        @csrf
        @include('admin.forms.partials.form-fields', ['form' => null])
        <button type="submit">ذخیره فرم</button>
    </form>
@endsection
