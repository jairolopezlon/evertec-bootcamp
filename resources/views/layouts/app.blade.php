<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Undefined title') | Ecommerce</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
    @stack('head')
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
</body>

</html>
