@extends('layouts.with-header-footer')

@section('forget-password')
    <section>


        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3>Ganti Kata Sandi</h3>
                            <hr class="mb-5">
                            <form action="/forgetpassword" method="POST">
                                @csrf
                                <div class="form-floating mb-3" style="text-align:left">
                                    <input type="password" name="password" class="form-control" placeholder="test" required style="@if(session('INVALID_LENGTH') || session('FAIL_CONFIRM')) border:2px solid red;@endif">                                                            
                                    @if(session('INVALID_LENGTH')) 
                                        <strong style="color:red;">{{session('INVALID_LENGTH')}}</strong>       
                                    @endif
                                    @if(session('FAIL_CONFIRM')) 
                                        <strong style="color:red;">{{session('FAIL_CONFIRM')}}</strong>       
                                    @endif                            
                                    <label for="password">Kata Sandi</label>
                                </div>                            
                                <div class="form-floating mb-3" style="text-align:left">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="test" required style="@if(session('FAIL_CONFIRM')) border:2px solid red;@endif">
                                    <label for="confirm_password">Konfirmasi Kata Sandi</label>
                                </div>   
                                <button class="mt-3 btn btn-warning btn-lg btn-block" type="submit">Ganti Kata Sandi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection