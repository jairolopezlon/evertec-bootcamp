<nav class="nav-main">
    <ul>
        <li>
            <a class="nav-item {{ Request::is('/') ? 'current-page' : '' }}" href="/">home</a>
        </li>
        @auth
            @if (auth()->user()->type === 'admin')
                <li>
                    <a class="nav-item {{ Request::is('dashboard') || Request::is('dashboard/*') ? 'current-page' : '' }}"
                        href="/dashboard">dashboard</a>
                </li>
            @endif
        @endauth
        @guest
            <li>
                <a class="nav-item {{ Request::is('login') ? 'current-page' : '' }}" href="/login">login</a>
            </li>
            <li>
                <a class="nav-item {{ Request::is('signup') ? 'current-page' : '' }}" href="/signup">signup</a>
            </li>
        @endguest
        @auth
            <li>
                <form method="POST" action="/logout">
                    @csrf
                    <button class="nav-item" type="submit">Logout</button>
                </form>
            </li>
        @endauth
    </ul>
</nav>
