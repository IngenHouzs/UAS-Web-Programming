<div class="navbar">
    @if (Route::has('login'))
            @auth
                <a href="{{ url('/test-auth-page') }}" class="text-sm">Dashboard</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            @else
                <a href="{{ route('login') }}" class="text-sm">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-sm">Register</a>
            @endif
            @endauth

    @endif
</div>
