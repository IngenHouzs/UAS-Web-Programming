<div class="navbar flex-row justify-around px-4">

    <div class="school-logo">
        <h4 class="rounded-top border border-info bg-light">Tunas Mulia Montessori School</h4>
    </div>
    
    


    <div class="nav-features">
        <a href=""><button class="rounded border border-warning">Home</button></a>
        <a href=""><button class="rounded border border-warning">About</button></a>
        <a href=""><button class="rounded border border-warning">Services</button></a>                
        <a href=""><button class="rounded border border-warning">Collection</button></a>        
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
