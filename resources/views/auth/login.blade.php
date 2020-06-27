@extends('layouts.app')

@section('content')    
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="/login" class="register-form2" method="post">
                        @csrf
                        <h2 class="login-heading">Login</h2>

                        @include('partials.errors')
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Email</label>
                                            <input type="email" name="email" class="form-control form-input">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Password</label>
                                            <input type="password" name="password" class="form-control form-input">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="remember1">
                                        <label class="remember">Remember
                                            <input type="checkbox">
                                            <span class="checkmark2"></span>
                                        </label>
                                    </p>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4 text-right">
                                    <p class="forgot"><a href="forgot-password.html" class="forgot-link">Forgot password?</a></p>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12"> 
                                <button class="sign-up">Login in</button>
                            </div>   
                            </div>
                            <div class="row">
                            <p class="already2">Don't have an account? <a href="/register" class="sign-up-link">Sign Up</a></p>  
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>

            </div>

        </div>

    </section>
@endsection

         