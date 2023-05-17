@extends('Layout.main')
@section('body')
<div class="container h-100"> 
    <div class="row justify-content-center h-100 align-items-center"> 
        <div class="col-md-6"> 
            <div class="card justify-content-center  align-items-center"> 
                <form action="{{ Route('auth.login') }}" method="POST" class="box login-form"> 
                    @csrf
                    <h1>Login</h1> 
                    <p class="text-muted"> 
                        Please enter your login and password!
                    </p> 
                    <div class="validation-input">
                        <input type="text" name="username" placeholder="Username or Email" value="{{old('username')}}"> 
                        <span class="username-span">{{$errors->has('username') ? $errors->first('username') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="password" name="password" placeholder="Password" value="{{old('password')}}"> 
                        <span class="password-span">{{$errors->has('password')? $errors->first('password') : ''}}</span>
                    </div>
                    <span>
                        <a class="forgot text-muted" href="{{ Route('forgot') }}">Forgot password?</a> 
                        or
                        <a class="text-muted" href="{{ Route('register') }}">register</a>
                    </span>
                    <button class="send-btn" type="button" onclick="sendForm()">Login</button>
                    <div class="col-md-12"> 
                        <ul class="social-network social-circle"> 
                            {{-- <li>
                                <a href="{{Route('auth.facebook')}}" class="icoFacebook" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>  --}}
                            <li>
                                <a href="#" class="icoTwitter" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li> 
                            <li>
                                <a href="{{Route('auth.google')}}" class="icoGoogle" title="Google +">
                                    <i class="fab fa-google-plus"></i>
                                </a>
                            </li> 
                        </ul> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div>
</div>
@endsection
@section('js')
<script>
    // check form inputs values by jquery
    function sendForm() {
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        var checkInput = '';
        if (username == '') {
            $('.username-span').text('Username is required');
            checkInput = 'username';
        }
        if (password == '') {
            $('.password-span').text('Password is required');
            checkInput = 'password';
        }
        if (checkInput == '') {
            $('.login-form').submit();
        }
    }
</script>
@endsection