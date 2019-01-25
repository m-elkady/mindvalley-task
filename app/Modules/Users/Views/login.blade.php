<!DOCTYPE html>
<html>
<head>
    <!-- Viewport metatags -->
    <meta name="HandheldFriendly" content="true"/>
    <meta name="MobileOptimized" content="320"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>
        @yield('title')
    </title>

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/responsive.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/plugins/pace.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('admin/js/pace.min.js') }}"></script>
@yield('css')

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="login-screen">
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="login-box">
                    <div class="login-content">
                        <img src="{{asset('admin/img/logo.png') }}"/>
                    </div>
                    <div class="login-form">
                        @include('flash::message')
                        {!! Form::open(['url'=>'admin/login', 'class'=>'form-horizontal ls_form'])  !!}
                        <div class="input-group ls-group-input">
                            {!! Form::text('username','',['class' => 'form-control', 'placeholder' => __('Username')]) !!}

                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        </div>
                        <div class="input-group ls-group-input">
                            {!! Form::password('password',['class' => 'form-control', 'placeholder' => __('Password')]) !!}
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        </div>
                        <div class="input-group ls-group-input login-btn-box">
                            <button type="submit" class="btn ls-dark-btn ladda-button col-md-12 col-sm-12 col-xs-12" ty
                                    data-style="slide-down">
                                <span class="ladda-label"><i class="fa fa-key"></i></span>
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<script type="text/javascript" src="{{ asset('admin/js/lib/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap.min.js') }}"></script>

</body>
</html>
