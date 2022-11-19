<div class="navbar">
    @guest
        <a href='/login'><button>Login</button></a>
        <a href="/registration"><button>Signup</button></a>
    @else 
        <p>Welcome, {{auth()->user()->name}}</p>
    @endguest
    
    <!-- TEST AUTH-->
    <a href="/testauth">khusus buat yg uhda login nih</a>

    <!-- FITUR ADMIN -->
    @auth
        @if(auth()->user()->role === 1)
            <h1>SAYA ADMIN</h1>
        @endif
    @endauth

    @auth 
        <form action="/logout" method="POST">
            @csrf
            <button>Log Out</button>
        </form>
    @endauth

</div>