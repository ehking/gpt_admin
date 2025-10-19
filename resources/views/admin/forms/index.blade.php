@extends('admin.layout')

@section('title', 'فرم‌های '.$panel->name)

@section('content')
    <header>
        <h1>فرم‌های {{ $panel->name }}</h1>
        <a href="{{ route('admin.forms.create', $panel) }}">فرم جدید</a>
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
            @foreach($forms as $form)
                <tr>
                    <td>{{ $form->name }}</td>
                    <td>{{ $form->slug }}</td>
                    <td><a href="{{ route('admin.forms.edit', [$panel, $form]) }}">ویرایش</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $forms->links() }}
@endsection
