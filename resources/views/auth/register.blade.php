
@extends('layouts.app')

@section('content')
    <section id="register">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <form action="/register" class="register-form" method="post">
                        @csrf
                        <h2 class="register-heading">Create your account</h2>
                        @include('partials.errors')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">First name</label>
                                    <input type="text" name="first_name" class="form-control form-input">
                                </div>
                            </div>    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Last name</label>
                                    <input type="text" name="last_name" class="form-control form-input">
                                </div>
                            </div>

                            </div>
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
                                <p class="agreement">By clicking Sign up with,you agree to the</p>
                                <p class="policy"><a href="#" class="policy-links">Terms of Use</a>&nbsp;and&nbsp;<a href="#" class="policy-links">Privacy Policy</a></p>
                            </div>
                            <div class="row">
                            <div class="col-md-12"> 
                                <button class="sign-up">Sign Up</button>
                            </div>   
                            </div>
                            <div class="row">
                            <p class="already">Already have an account? <a href="login.html" class="log-in">Login in</a></p>  
                        </div>
                    </form>
                </div>
                <div class="col-md-3"></div>

            </div>

        </div>

    </section>
@endsection

