<nav id="navbar" class="navbar navbar-expand-md px-3 fixed-top">
    <img class="img-navbar-footer" src="/asset/tunas-mulia-logo.png"/>
    <a href="" id="navbar-school-name">
        Tunas Mulia Montessori School <br>
        Online Library
    </a>
    <button class="navbar-toggler-icon" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        @include('components.hamburg-toggler')
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarsExample04">
        <div id="navbar-menu" class="navbar-nav">
            {{--<li class="nav-item">
                <a href="{{route('home')}}" class="navbar-link nav-link-rounded rounded">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{route('about')}}" class="navbar-link nav-link rounded">About</a>
            </li>
            <li class="nav-item">
                <a href="{{route('collection')}}" class="navbar-link nav-link rounded">Collection</a>     
            </li>--}}


            @auth            
            @if(auth()->user()->role == 1)            
                <li class="nav-item">
                    <a href="{{route('showAllLoans')}}" class="navbar-link nav-link rounded">Data Pinjaman</a>     
                </li>    
                <li class="nav-item">
                    <a href="{{route('showPendingRequests')}}" class="navbar-link nav-link rounded">Pending</a>     
                </li>                    
                <li class="nav-item">
                    <a href="{{route('collection')}}" class="navbar-link nav-link rounded">Monitor Katalog</a>     
                </li>  
                <li class="nav-item">
                    <a href="{{route('viewAllStudent')}}" class="navbar-link nav-link rounded">Data Pelajar</a>     
                </li>                                                       
            @elseif(auth()->user()->role == 2)
                <li class="nav-item">
                    <a href="{{route('home')}}" class="navbar-link nav-link rounded">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('about')}}" class="navbar-link nav-link rounded">Guide</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('collection')}}" class="navbar-link nav-link rounded">Collection</a>     
                </li>          
                <li class="nav-item">
                    <a href="{{route('pinjamanku')}}" class="navbar-link nav-link rounded">My Book</a>     
                </li>                    
            @endif
            @endauth

            @guest 
                <li class="nav-item">
                    <a href="{{route('home')}}" class="navbar-link nav-link rounded">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('about')}}" class="navbar-link nav-link rounded">Guide</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('collection')}}" class="navbar-link nav-link rounded">Collection</a>     
                </li>               
            @endguest 
        </div>

        <div class="navbar-nav" id="navbar-user-status">
            @auth 
                @if(auth()->user()->role == 2)
                    <li class="nav-item">
                        <a href="{{route('forgetPasswordView')}}" class="navbar-link nav-link rounded">Ganti Kata Sandi</a>     
                    </li>                      
                @endif 
            @endauth 

            @if (Route::has('login'))
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();" class="log-in-out nav-item nav-link">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </form>

                    @else
                        <a href="{{ route('login') }}" class="log-in-out nav-item nav-link rounded" >Log in</a>
                    @endauth
            @endif
        </div>
    </div>
</nav>
