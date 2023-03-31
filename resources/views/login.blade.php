<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form method="POST" id="loginForm">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="pasword">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Login</button>
    </form>
</body>

</html>
