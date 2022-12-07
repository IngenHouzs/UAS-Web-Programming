@extends('layouts.with-header-footer')

@section('forget-password')

    <h1>Forget password</h1>

    <form action="/forgetpassword" method="POST">
        @csrf
        <input type="password" name="password" placeholder="Masukkan kata sandi baru" required>
        <input type="password" name="confirm_password" placeholder="Masukkan kembali ata sandi baru" required>        

        <button type="submit">Ganti Kata Sandi</button>

    </form>

    

@endsection