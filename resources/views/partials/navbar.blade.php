<div class="navbar flex-row justify-around px-4">

    <div class="school-logo">
        <h4 class="rounded-top border border-info bg-light">Tunas Mulia Montessori School</h4>
    </div>
    
    


    <div class="nav-features">
        <a href="{{route('home')}}" class="rounded border border-warning"><button>Home</button></a>
        <a href="{{route('about')}}" class="rounded border border-warning"><button>About</button></a>
        <a href="{{route('services')}}" class="rounded border border-warning"><button>Services</button></a>                
        <a href="{{route('collection')}}" class="rounded border border-warning"><button>Collection</button></a>        
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
</div>
