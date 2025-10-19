@extends('admin.layout')

@section('title', 'کاربران '.$panel->name)

@section('content')
    <h1>کاربران {{ $panel->name }}</h1>
    <form method="POST" action="{{ route('admin.panels.users.store', $panel) }}">
        @csrf
        <label>کاربر
            <select name="user_id" required>
                @foreach($availableUsers as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </label>
        <label>نقش در پنل
            <input type="text" name="role" placeholder="مثلاً manager" required>
        </label>
        <button type="submit">افزودن</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>کاربر</th>
                <th>نقش</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($panel->users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->pivot->role }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.panels.users.destroy', [$panel, $user]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
