<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students App</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <h1>Students App</h1>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }}</p>
</footer>
</body>
</html>
