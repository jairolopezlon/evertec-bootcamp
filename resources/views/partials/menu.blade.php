<nav class="nav-main">
    <ul>
        <li>
            <a href="/">home</a>
        </li>
        @auth
            <li>
                <a href="/dashboard">dashboard</a>
            </li>
        @endauth
        @guest
            <li>
                <a href="/login">login</a>
            </li>
            <li>
                <a href="/signup">signup</a>
            </li>
        @endguest
        @auth
            <li>
                <a href="/logout">Logout</a>
            </li>
        @endauth
    </ul>
</nav>
