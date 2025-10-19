@extends('admin.layout')

@section('title', 'ویرایش فرم '.$form->name)

@section('content')
    <h1>ویرایش فرم {{ $form->name }}</h1>
    <form method="POST" action="{{ route('admin.forms.update', [$panel, $form]) }}">
        @csrf
        @method('PUT')
        @include('admin.forms.partials.form-fields', ['form' => $form])
        <button type="submit">به‌روزرسانی فرم</button>
    </form>
@endsection
