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
    <link href="{{ asset('admin/css/plugins/summernote.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/plugins/jquery.datetimepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/plugins/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/css/plugins/pace.css') }}" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="{{ asset('admin/js/pace.min.js') }}"></script>
@stack('css')


<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="<!--deep-blue-color--> black-color ">
<nav class="navigation">
    <div class="container-fluid">
        <!--Logo text start-->
        <div class="header-logo">
            <a href="{{url('admin')}}" title="">
                <h1> {{ 'MindValley'}} </h1>

            </a>
        </div>
        <!--Logo text End-->
        <div class="top-navigation">
            <!--Collapse navigation menu icon start -->
            <div class="menu-control hidden-xs">
                <a href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a>
            </div>


            <!--Collapse navigation menu icon end -->
            <!--Top Navigation Start-->

            <ul>
                <li>
                    <i class="fa fa-user"></i> {{ __('Hello') .' '.( $user['username'] ?? 'Admin') }}
                    <a href="{{ url(route('admin.logout')) }}">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>

            </ul>
            <!--Top Navigation End-->
        </div>
    </div>
</nav>
<!--Navigation Top Bar End-->
<section id="main-container">

    <!--Left navigation section start-->
    <section id="left-navigation">
        <!--Left navigation user details start-->
        <div class="user-image">
            <img src="{{asset('admin/img/logo.png') }}"/>
        </div>

        <!--Left navigation user details end-->

        <!--Phone Navigation Menu icon start-->
        <div class="phone-nav-box visible-xs">
            <a class="phone-logo" href="index.html" title="">
                <h1><{{ $config['site_name']??'en' }}</h1>
            </a>
            <a class="phone-nav-control" href="javascript:void(0)">
                <span class="fa fa-bars"></span>
            </a>
            <div class="clearfix"></div>
        </div>
        <!--Phone Navigation Menu icon start-->

        <!--Left navigation start-->
        <ul class="mainNav">
            @include('elements.sideMenu', ['items' => Config::get('sideMenu')])
        </ul>
        <!--Left navigation end-->
    </section>
    <!--Left navigation section end-->


    <!--Page main section start-->
    <section id="min-wrapper">
        <div id="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <!--Top header start-->

                        <!--Top header end -->
                        <!--Top breadcrumb start -->
                    @include('elements.crumbs')
                    <!--Top breadcrumb start -->
                    </div>
                </div>
                <!-- Main Content Element  Start-->
                <div class="row">
                    <div class="col-md-12">
                        @include('flash::message')
                        @yield('content')
                    </div>
                </div>

                <!-- Main Content Element  End-->

            </div>
        </div>
    </section>
    <!--Page main section end -->

</section>


<footer>
</footer>

<script type="text/javascript" src="{{ asset('admin/js/lib/jquery-1.11.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/summernote.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/multipleAccordion.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/lib/jquery.easing.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/pages/layout.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/jquery.validate.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/jquery.datetimepicker.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/bootstrap-filestyle.min.js') }}"></script>


<script>
    $(function () {
        jQuery.extend(jQuery.validator.messages, {
            required: "<?php echo __('Required') ?>",
            email: "<?php echo __('Please enter a valid email') ?>",
            url: "<?php echo __('Please enter a valid url') ?>",
            digits: "<?php echo __('This field accepts numbers only') ?>",
        });
        $('.select2').select2();
        $('.dateTimePicker').datetimepicker({
            format: 'Y-m-d H:i'
        });

        $('.datePicker').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            scrollInput: false
        });

        $(":file").filestyle({
            placeholder: '<?php echo __('No File') ?>',
            buttonText: '<?php echo __('Choose File') ?>',
            buttonName: "btn-primary",
            input: false
        });

        $('.summernote').summernote({
            height: '300px',
            dialogsFade: true,
            dialogsInBody: true
        });

        $("#checkall").on('click', function () {
            $(this).closest('table').find('input[type=checkbox][name="chk[]"]').prop('checked', $(this).is(':checked'));
        });

        $("#acts").on('change', function () {
            var action = $(this).val();
            if (action !== "") {
                if ($('input[name="chk[]"]:checked').length === 0) {
                    alert('You should select one item at least.');
                    $(this).val('');
                } else {
                    var del = confirm('You sure you want to perform this operation?');
                    if (del) {
                        $(this).closest('form').submit();
                        $(this).val('');
                    } else {
                        $(this).val('');
                    }
                }
            }
        });
    });
</script>

<script>
    $(function () {
        $('.note-modal-form').each(function () {
            $(this).validate({})
        });
    });
</script>

@stack('scripts')

</body>
</html>