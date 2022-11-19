<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
</head>
<body>
    Sign Up Page

    <form action="/registration" method="POST">
        @csrf
        
        <!-- ini hidden, jangan diapa-apain ya-->
        <input type="id" value="" hidden/>

        <input type="text" name="name" required>Name</input>
        @error('name')
            {{$message}}
        @enderror
        <input type="email" name="email" required>Email</input>        
        @error('email')
            {{$message}}
        @enderror  
        <input type="password" name="password" required>Password</input>        
        @error('password')
            {{$message}}
        @enderror
        <button type="submit">Submit</button>




    </form>
</body>
</html>