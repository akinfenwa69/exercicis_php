<!doctype html>
<html lang="ca">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/assets/styles/globals.css">
    <title>@yield('title', 'Videojocs')</title>
</head>

<body>
    @if (session('status'))
        <p style="border:1px solid #ccc; padding:8px;">{{ session('status') }}</p>
    @endif

    <nav>
        <div>
            <img src="/assets/images/logo.png" alt="logo">
            <ul>
                <li><a href="/videojocs">Home</a></li>
                <li><a href="/videojocs/create">New</a></li>
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>

</html>
