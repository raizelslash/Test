
<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
@yield('meta')
<!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('assets/home/images/icons/favicon.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/fonts/iconic/css/material-design-iconic-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/animsition/css/animsition.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/daterangepicker/daterangepicker.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/slick/slick.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/vendor/MagnificPopup/magnific-popup.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/home/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/home/css/main.css')}}">
    <!--===============================================================================================-->

    <style>
        .dropbtn {
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .main-menu li,
        .dropdown li {
            position: relative;
        }

        .main-menu li:hover .dropdown,
        .dropdown li:hover .dropdown-subcontent {

            display: block;
        }

        .dropdown,
        .dropdown-subcontent {
            min-width: 160px;

            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);

        }

        .dropdown li a:hover,
        .dropdown-subcontent li a:hover {
            background-color: #f1f1f1

        }

        .dropdown {
            position: absolute;
            top: 100%;
            display: none;
        }

        .dropdown-subcontent {
            position: absolute;
            left: 100%;
            top: 0;
            display: none;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #dddddd;
        }

        .dropdown li {
            width: 213px;
        }


    </style>
</head>
<body class="animsition">
