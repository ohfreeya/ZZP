@extends('Layout.main')
@section('body')
<div class="container h-100"> 
    <div class="row justify-content-center h-100 align-items-center"> 
        <div class="col-md-6"> 
            <div class="card justify-content-center align-items-center"> 
                <form action="{{ Route('register') }}" method="POST" class="box"> 
                    @csrf
                    <h1>Register</h1>
                    <div class="validation-input">
                        <input type="text" name="username" placeholder="Username">
                        <span class="text-danger">{{$errors->has('username') ? $errors->first('username') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="text" name="email" placeholder="email">
                        <span class="text-danger">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="password" name="password" placeholder="Password">
                        <span class="text-danger">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="password" name="confirm" placeholder="Confirm password">
                        <span class="text-danger"></span>
                    </div>
                    <span>
                        Already having account? 
                        <a class="text-muted" href="{{ Route('login_page') }}">Login</a>
                    </span>
                    <button class="send-btn">Register</button>
                </form> 
            </div> 
        </div> 
    </div>
</div>
@endsection
<script>
    // identify the password and confirm password fields
    var confirmPassword = document.getElementById('confirm');
    var password = document.getElementById('password');


    
</script>