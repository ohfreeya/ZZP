@extends('Layout.main')
@section('body')
<div class="container h-100"> 
    <div class="row justify-content-center h-100 align-items-center"> 
        <div class="col-md-6"> 
            <div class="card justify-content-center align-items-center"> 
                <form action="{{ Route('register') }}" method="POST" class="box register-form"> 
                    @csrf
                    <h1>Register</h1>
                    <div class="validation-input">
                        <input type="text" name="username" placeholder="Username" id="username" value="{{old('username')}}">
                        <span class="username-span">{{$errors->has('username') ? $errors->first('username') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="text" name="email" placeholder="email" id="email" value="{{old('email')}}">
                        <span class="email-span">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="password" name="password" placeholder="Password" id="password" value="{{old('password')}}">
                        <span class="password-span">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="password" name="confirm" placeholder="Confirm password" id="confirm">
                        <span class="confirm-span"></span>
                    </div>
                    <span>
                        Already having account? 
                        <a class="text-muted" href="{{ Route('login') }}">Login</a>
                    </span>
                    <button class="send-btn" onclick="checkForm()">Register</button>
                </form> 
            </div> 
        </div> 
    </div>
</div>
@endsection
<script>
    // check form's input values by jqery
    function checkForm() {
        event.preventDefault();
        var checkInput = '';
        // check form values is not empty
        if ($('#username').val() == '') {
            $('.username-span').text('Username is required');
            checkInput = 'username';
        }
        if ($('#email').val() == '') {
            $('.email-span').text('Email is required');
            checkInput = 'email';
        } 
        if ($('#password').val() == '') {
            $('.password-span').text('Password is required');
            checkInput = 'password';
        } 
        if ($('#confirm').val() == '') {
            $('.confirm-span').text('Confirm Password is required');
            checkInput = 'confirm';
        }
        if (checkInput == '') {
            // send form
            $('.register-form').submit();
        }

    }
</script>