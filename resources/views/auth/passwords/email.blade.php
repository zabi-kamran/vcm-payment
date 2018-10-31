@extends('layout.log')
@section('title','Reset Password')
@section('body')
<body class="login-container">

    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content pb-20">

                    <!-- Advanced login -->
                     <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <h5 class="content-group-lg">Login to your account <small class="display-block">Enter your credentials</small></h5>
                            </div>
                               <div class="form-group has-feedback has-feedback-left">
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Username">
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                                 @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        

                            <div class="form-group">
                                <button type="submit" class="btn bg-blue btn-block">Send Password Reset Link <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                                <div class="form-group login-options">
                                <div class="row">
                                    <div class="col-sm-12 text-right">
                                        <a href="{{ route('login') }}">Login?</a>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <!-- /advanced login -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</body>
@endsection
