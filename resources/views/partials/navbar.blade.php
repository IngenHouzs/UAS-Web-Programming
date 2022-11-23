<div class="navbar flex-row justify-around px-4">

    <div class="school-logo">
        <p>Tunas Mulia Montessori School</p>
    </div>


    <div class="nav-features">
        <a href=""><button>Home</button></a>
        <a href=""><button>About</button></a>
        <a href=""><button>Services</button></a>                
        <a href=""><button>Collection</button></a>        
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
                    <a href="{{ route('login') }}" class="text-sm" >Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm">Register</a>
                @endif
                @endauth
        @endif
    </div>
</div>
