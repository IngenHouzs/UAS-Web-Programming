<nav class="navbar navbar-expand-lg px-3">
    <a class="navbar-brand school-logo" href="#">
        LOGO
    </a>
    <a href="\">
        Tunas Mulia Montessori School <br>
        Online Library
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExample04">
        <div class="navbar-nav">
            <a href="{{route('home')}}" class="nav-item nav-link"><button>Home</button></a>
            <a href="{{route('about')}}" class="nav-item nav-link"><button>About</button></a>
            <a href="{{route('services')}}" class="nav-item nav-link"><button>Services</button></a>                
            <a href="{{route('collection')}}" class="nav-item nav-link"><button>Collection</button></a>     
        </div>
    </div>

    <div class="nav-user-status">
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
                    <a href="{{ route('login') }}" class="rounded border border-dark bg-light" >Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="rounded border border-dark bg-light">Register</a>
                @endif
                @endauth
        @endif
    </div>
</nav>
