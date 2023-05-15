@extends('Layout.main')
@section('body')
<div class="container h-100"> 
    <div class="row justify-content-center h-100 align-items-center"> 
        <div class="col-md-6"> 
            <div class="card justify-content-center  align-items-center"> 
                <form action="{{ Route('login_auth') }}" method="POST" class="box"> 
                    @csrf
                    <h1>Login</h1> 
                    <p class="text-muted"> 
                        Please enter your login and password!
                    </p> 
                    <input type="text" name="username" placeholder="Username or Email"> 
                    <input type="password" name="password" placeholder="Password"> 
                    <span>
                        <a class="forgot text-muted" href="#">Forgot password?</a> 
                        or
                        <a class="text-muted" href="{{ Route('register') }}">register</a>
                    </span>
                    <button class="send-btn" type="button" onclick="sendForm()">Login</button>
                    <div class="col-md-12"> 
                        <ul class="social-network social-circle"> 
                            <li>
                                <a href="#" class="icoFacebook" title="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li> 
                            <li>
                                <a href="#" class="icoTwitter" title="Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li> 
                            <li>
                                <a href="#" class="icoGoogle" title="Google +">
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

</script>
@endsection