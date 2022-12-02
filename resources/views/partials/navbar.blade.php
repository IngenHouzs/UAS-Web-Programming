<nav id="navbar" class="navbar navbar-expand-md px-3 fixed-top">
    <img class="img" src="https://o.remove.bg/downloads/4d14cd88-ebd7-4c5a-81a2-f69f913f6218/download-removebg-preview.png"/>
    <a href="\" id="navbar-school-name">
        Tunas Mulia Montessori School <br>
        Online Library
    </a>
    <button class="navbar-toggler-icon" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        @include('components.hamburg-toggler')
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarsExample04">
        <div class="navbar-nav">
{{-- 
            <li class="nav-item">
                <a href="{{route('home')}}" class="navbar-link nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="{{route('about')}}" class="navbar-link nav-link">About</a>
            </li>
            <li class="nav-item">
                <a href="{{route('services')}}" class="navbar-link nav-link">Services</a>
            </li>
            <li class="nav-item">
                <a href="{{route('collection')}}" class="navbar-link nav-link">Collection</a>     
            </li> --}}

            <!--<div class="dropdown">
                <button class="dropbtn">Dropdown
                  <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                  <a href="#">Link 1</a>
                  <a href="#">Link 2</a>
                  <a href="#">Link 3</a>
                </div>-->

            <div class="search-box">
    <button class="btn-search"><i class="fas fa-search"></i></button>
    <input type="text" class="input-search" placeholder="Type to Search...">
  </div>
        </form>
            @auth
                @if(auth()->user()->role === 1)            
                    <li class="nav-item">
                        <a href="{{route('showAllLoans')}}" class="navbar-link nav-link">Loan List</a>     
                    </li>                
                @endif
            @endauth            


            @auth            
            @if(auth()->user()->role === 1)            
                <li class="nav-item">
                    <a href="{{route('showAllLoans')}}" class="navbar-link nav-link">Data Pinjaman</a>     
                </li>    
                <li class="nav-item">
                    <a href="{{route('showPendingRequests')}}" class="navbar-link nav-link">Pending</a>     
                </li>                    
                <li class="nav-item">
                    <a href="{{route('collection')}}" class="navbar-link nav-link">Monitor Katalog</a>     
                </li>                                 
            @elseif(auth()->user()->role === 2)
                <li class="nav-item">
                    <a href="{{route('home')}}" class="navbar-link nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('about')}}" class="navbar-link nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('services')}}" class="navbar-link nav-link">Services</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('collection')}}" class="navbar-link nav-link">Collection</a>     
                </li>           
            @endif
            @endauth

            @guest 
                <li class="nav-item">
                    <a href="{{route('home')}}" class="navbar-link nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('about')}}" class="navbar-link nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('services')}}" class="navbar-link nav-link">Services</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('collection')}}" class="navbar-link nav-link">Collection</a>     
                </li>               
            @endguest 


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
                <!-- @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                @endif -->
                @endauth
        @endif
        </div>
    </div>
</nav>
