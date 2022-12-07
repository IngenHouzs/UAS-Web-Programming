@extends('layouts.footer-only')

@section('login') 
<<<<<<< HEAD

=======
>>>>>>> 83377d9d96fb05f6314b4d2e9f6221982534ad1f
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <h3>Log In</h3>
                            <hr class="mb-5">

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                    <div class="form-floating mb-3">
                                        <input id="nisn" type="text" name="nisn" class="form-control  @error('nisn') is-invalid @enderror" placeholder="name@example.com" value="{{ old('nisn') }}" required autocomplete="nisn" autofocus>
                                        @error('nisn')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <label for="nisn">{{ __('NISN') }}</label>
                                    </div>

                                    <div class="form-floating">
                                        <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                    <button class="mt-3 btn btn-primary btn-lg btn-block" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 83377d9d96fb05f6314b4d2e9f6221982534ad1f
