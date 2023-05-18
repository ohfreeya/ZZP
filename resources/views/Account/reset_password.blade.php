@extends('Layout.main')
@section('body')
<div class="container h-100"> 
    <div class="row justify-content-center h-100 align-items-center"> 
        <div class="col-md-6"> 
            <div class="card justify-content-center  align-items-center"> 
                <form action="{{ Route('store.reset', ['token'=> $token]) }}" method="POST" class="box login-form"> 
                    @csrf
                    <h1>Reset Passwor</h1> 
                    <p class="text-muted"> 
                        Please enter your new password!
                    </p> 
                    <div class="validation-input">
                        <input type="password" name="password" placeholder="Password" value="{{old('password')}}"> 
                        <span class="password-span">{{$errors->has('password')? $errors->first('password') : ''}}</span>
                    </div>
                    <div class="validation-input">
                        <input type="password" name="confirm" placeholder="Confirm Password" value="{{old('confirm')}}"> 
                        <span class="confirm-span">{{$errors->has('confirm')? $errors->first('confirm') : ''}}</span>
                    </div>
                    <button class="send-btn" type="button" onclick="sendForm()">Reset</button>
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
        var confirm = $('#confirm').val();
        var password = $('#password').val();
        var checkInput = '';
        if (confirm == '') {
            $('.confirm-span').text('Confirm Password is required');
            checkInput = 'confirm';
        } else if (confirm != password) {
            $('.confirm-span').text('Passwords do not match');
            checkInput = 'confirm';
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