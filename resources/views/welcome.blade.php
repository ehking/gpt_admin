<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
    </head>
    <body>
        <main class="container">
            <h1>{{ config('app.name') }}</h1>
            <p>برای ورود روی دکمه زیر کلیک کنید.</p>
            <a class="contrast" href="{{ route('oauth.redirect') }}">ورود با OAuth2</a>
        </main>
    </body>
</html>
