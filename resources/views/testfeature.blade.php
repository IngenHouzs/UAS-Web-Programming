<!-- TEMPLATE TESTING PAGE KHUSUS USER YANG UDAH LOGIN -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    KALO LU DAH LOGIN YA BISA KESINI
    @auth 
        <p>wkwkwkkw</p>
        {{auth()->user()->name}}
    @endauth
</body>
</html>