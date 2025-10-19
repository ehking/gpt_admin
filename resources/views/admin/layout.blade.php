<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') }} - @yield('title')</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    </head>
    <body>
        <nav class="container">
            <ul>
                <li><strong>{{ config('app.name') }}</strong></li>
            </ul>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">داشبورد</a></li>
                <li><a href="{{ route('admin.panels.index') }}">پنل‌ها</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">خروج</button>
                    </form>
                </li>
            </ul>
        </nav>
        <main class="container">
            @if(session('status'))
                <article>{{ session('status') }}</article>
            @endif
            @yield('content')
        </main>
    </body>
</html>
