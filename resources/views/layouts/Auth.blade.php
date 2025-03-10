<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- title page -->
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/themes/semi-dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/pages/authentication.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/css/extensions/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css-rtl/mystyle.css') }}">
    <style>
        #floatingCirclesG {
            position: relative;
            width: 125px;
            height: 125px;
            margin: auto;
            transform: scale(0.4);
            -o-transform: scale(0.4);
            -ms-transform: scale(0.4);
            -webkit-transform: scale(0.4);
            -moz-transform: scale(0.4);
        }

        .f_circleG {
            position: absolute;
            height: 22px;
            width: 22px;
            border-radius: 12px;
            -o-border-radius: 12px;
            -ms-border-radius: 12px;
            -webkit-border-radius: 12px;
            -moz-border-radius: 12px;
            animation-name: f_fadeG;
            -o-animation-name: f_fadeG;
            -ms-animation-name: f_fadeG;
            -webkit-animation-name: f_fadeG;
            -moz-animation-name: f_fadeG;
            animation-duration: 1.2s;
            -o-animation-duration: 1.2s;
            -ms-animation-duration: 1.2s;
            -webkit-animation-duration: 1.2s;
            -moz-animation-duration: 1.2s;
            animation-iteration-count: infinite;
            -o-animation-iteration-count: infinite;
            -ms-animation-iteration-count: infinite;
            -webkit-animation-iteration-count: infinite;
            -moz-animation-iteration-count: infinite;
            animation-direction: normal;
            -o-animation-direction: normal;
            -ms-animation-direction: normal;
            -webkit-animation-direction: normal;
            -moz-animation-direction: normal;
        }

        #frotateG_01 {
            left: 0;
            top: 51px;
            animation-delay: 0.45s;
            -o-animation-delay: 0.45s;
            -ms-animation-delay: 0.45s;
            -webkit-animation-delay: 0.45s;
            -moz-animation-delay: 0.45s;
        }

        #frotateG_02 {
            left: 15px;
            top: 15px;
            animation-delay: 0.6s;
            -o-animation-delay: 0.6s;
            -ms-animation-delay: 0.6s;
            -webkit-animation-delay: 0.6s;
            -moz-animation-delay: 0.6s;
        }

        #frotateG_03 {
            left: 51px;
            top: 0;
            animation-delay: 0.75s;
            -o-animation-delay: 0.75s;
            -ms-animation-delay: 0.75s;
            -webkit-animation-delay: 0.75s;
            -moz-animation-delay: 0.75s;
        }

        #frotateG_04 {
            right: 15px;
            top: 15px;
            animation-delay: 0.9s;
            -o-animation-delay: 0.9s;
            -ms-animation-delay: 0.9s;
            -webkit-animation-delay: 0.9s;
            -moz-animation-delay: 0.9s;
        }

        #frotateG_05 {
            right: 0;
            top: 51px;
            animation-delay: 1.05s;
            -o-animation-delay: 1.05s;
            -ms-animation-delay: 1.05s;
            -webkit-animation-delay: 1.05s;
            -moz-animation-delay: 1.05s;
        }

        #frotateG_06 {
            right: 15px;
            bottom: 15px;
            animation-delay: 1.2s;
            -o-animation-delay: 1.2s;
            -ms-animation-delay: 1.2s;
            -webkit-animation-delay: 1.2s;
            -moz-animation-delay: 1.2s;
        }

        #frotateG_07 {
            left: 51px;
            bottom: 0;
            animation-delay: 1.35s;
            -o-animation-delay: 1.35s;
            -ms-animation-delay: 1.35s;
            -webkit-animation-delay: 1.35s;
            -moz-animation-delay: 1.35s;
        }

        #frotateG_08 {
            left: 15px;
            bottom: 15px;
            animation-delay: 1.5s;
            -o-animation-delay: 1.5s;
            -ms-animation-delay: 1.5s;
            -webkit-animation-delay: 1.5s;
            -moz-animation-delay: 1.5s;
        }

        @keyframes f_fadeG {
            0% {
                background-color: rgb(47, 146, 212);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-o-keyframes f_fadeG {
            0% {
                background-color: rgb(47, 146, 212);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-ms-keyframes f_fadeG {
            0% {
                background-color: rgb(47, 146, 212);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-webkit-keyframes f_fadeG {
            0% {
                background-color: rgb(47, 146, 212);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }

        @-moz-keyframes f_fadeG {
            0% {
                background-color: rgb(47, 146, 212);
            }

            100% {
                background-color: rgb(255, 255, 255);
            }
        }
    </style>
</head>
<body class="pace-done vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <div id="app">
        <!-- content -->
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('backend/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/js/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/js/extensions/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('backend/js/core/app.js') }}"></script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })

        function Login() {
        }

        Login.userNameInput = 'userNameInput';
        Login.passwordInput = 'passwordInput';

        Login.initialize = function () {

            var u = new InputUtil();

            u.checkError();
            u.setInitialFocus(Login.userNameInput);
            u.setInitialFocus(Login.passwordInput);
        }();

        Login.submitLoginRequest = function () { 
            var u = new InputUtil();
            var e = new LoginErrors();

            var userName = document.getElementById(Login.userNameInput);
            var password = document.getElementById(Login.passwordInput);

            if (!userName.value || !userName.value.match('[@\\\\]')) {
                u.setError(userName, e.userNameFormatError);
                return false;
            }

            if (!password.value) {
                u.setError(password, e.passwordEmpty);
                return false;
            }

            if (password.value.length > maxPasswordLength) {
                u.setError(password, e.passwordTooLong);
                return false;
            }

            document.forms['loginForm'].submit();
            return false;
        };

        InputUtil.makePlaceholder(Login.userNameInput);
        InputUtil.makePlaceholder(Login.passwordInput);
    </script>
    <script type="text/javascript">
        function SelectOption(option) {
            var w = document.getElementById('waitingWheelDiv');
            if(w) w.style.display = 'inline';
            var i = document.getElementById('optionSelection');
            i.value = option;
            document.forms['options'].submit();
            return false;
        }
    </script>
    @yield('js')
</body>
</html>
