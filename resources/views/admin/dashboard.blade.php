@extends('admin.layout')

@section('title', 'داشبورد')

@section('content')
    <h1>سلام، {{ $user->name }}</h1>
    <p>از داشبورد مدیریت می‌توانید پنل‌های جدید ایجاد کنید، فرم‌های پویا بسازید و گزارش‌های تعاملی تعریف کنید.</p>
@endsection
