<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div>
            @include('partials.menu')
        </div>
        <h1>Home</h1>
        @Auth
            <p>bienvenido {{ auth()->user() }}</p>
        @endauth
        <h3>laravel session</h3>
        <pre>
            {{ session('email') }}
        </pre>
    </div>
</body>

</html>
