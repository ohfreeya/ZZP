@extends('Layout.main')
@section('body')
<div class="container h-100"> 
    <div class="row justify-content-center h-100 align-items-center"> 
        <div class="col-md-6"> 
            <div class="card justify-content-center align-items-center"> 
                <form action="{{ Route('verify.email') }}" method="POST" class="box register-form"> 
                    @csrf
                    <h1>Forgot password</h1>
                    <div class="validation-input">
                        <input type="text" name="email" placeholder="email" id="email" value="{{old('email')}}">
                        <span class="email-span">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                    </div>
                    <span>
                        Back to  
                        <a class="text-muted" href="{{ Route('login') }}">Login</a>
                    </span>
                    <button class="send-btn" >send</button>
                </form> 
            </div> 
        </div> 
    </div>
</div>
@endsection