<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
</head>
<body>
    Login Page

    <form action="/login" method="POST">
        @csrf
        
        @if(session()->has('LOGIN_ERROR'))
            <h1>{{session('LOGIN_ERROR')}}</h1>
        @endif

        <input type="email" name="email" required>Email</input>        
        <input type="password" name="password" required>Password</input>        
        <button type="submit">Submit</button>




    </form>


</body>
</html>