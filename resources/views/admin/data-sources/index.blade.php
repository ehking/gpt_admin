@extends('admin.layout')

@section('title', 'منابع داده')

@section('content')
    <header>
        <h1>منابع داده</h1>
        <a href="{{ route('admin.data-sources.create') }}">افزودن منبع داده</a>
    </header>
    <table>
        <thead>
            <tr>
                <th>نام</th>
                <th>نوع</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataSources as $source)
                <tr>
                    <td>{{ $source->name }}</td>
                    <td>{{ $source->driver }}</td>
                    <td><a href="{{ route('admin.data-sources.edit', $source) }}">ویرایش</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $dataSources->links() }}
@endsection
