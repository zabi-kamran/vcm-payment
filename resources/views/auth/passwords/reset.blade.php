@extends('log.app')
@section('title','Reset Password')
@section('content')
<div class="login-content">
    <!-- Login -->
    <div class="lc-block toggled" id="l-login">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <div class="lcb-form">
         <h4>Reset Password</h4>
         <hr>
         <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
            {{ csrf_field() }}

            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group fg-float{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="fg-line">
                    <input id="email" type="email" class="input-lg form-control fg-input" name="email" value="{{ $email or old('email') }}" required autofocus>
                    <label class="fg-label">E-Mail Address</label>
                </div>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
            
            <div class="form-group fg-float{{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="fg-line">
                    <input id="password" type="password" class="input-lg form-control fg-input" name="password" required>
                    <label class="fg-label">Password</label>
                    
                </div>
                @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group fg-float{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
             
                <div class="fg-line">
                    <input id="password-confirm" type="password" class="input-lg form-control fg-input" name="password_confirmation" required>
                    <label class="fg-label">Confirm Password</label>
                    
                </div>
                @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Reset Password
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>

@endsection
