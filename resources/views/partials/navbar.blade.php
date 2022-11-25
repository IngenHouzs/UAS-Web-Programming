<nav class="navbar navbar-expand-md px-3">
    <a class="navbar-brand" href="\">
        LOGO
    </a>
    <a href="\" id="navbar-school-name">
        Tunas Mulia Montessori School <br>
        Online Library
    </a>
    <button class="navbar-toggler-icon" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        @include('components.hamburg-toggler')
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarsExample04">
        <div class="navbar-nav">
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{route('about')}}" class="nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="{{route('services')}}" class="nav-link">Services</a>
            </li>
            <li class="nav-item">
                <a href="{{route('collection')}}" class="nav-link">Collection</a>     
            </li>

        </div>
        <div class="navbar-nav" id="navbar-user-status">
        @if (Route::has('login'))
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>

                @else
                    <a href="{{ route('login') }}" class="nav-item nav-link" >Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                @endif
                @endauth
        @endif
        </div>
    </div>
</nav>
