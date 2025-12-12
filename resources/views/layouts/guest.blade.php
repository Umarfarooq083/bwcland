<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ url('admin/assets/images/bwc.png') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('admin/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="{{ url('admin/assets/css/main.css') }}">
    </head>
    <body data-theme="light" class="font-nunito">
        <div id="wrapper" class="theme-cyan">
            <div class="page-loader-wrapper font-18 cstm_loader" style="background: rgba(0, 0, 0, 0.48); display: none;">
                <div class="loader">
                    <div class="spinner-border text-white"></div>
                    <p>Please wait...</p>
                </div>
            </div>
            @php
                $heading = trim($__env->yieldContent('formHeading', 'Create an account'));
            @endphp
            <div class="vertical-align-wrap text-center">
                <div class="vertical-align-middle auth-main realestate">
                    <div class="auth-box d-inline-block m-0 {{ $heading === 'Create an account' ? 'register_auth' : '' }}">
                        <div class="card">
                            <div class="header pb-0">
                                <a href="/" class="top d-inline-flex justify-content-center m-0">
                                    <img src="{{ url('admin/assets/images/bwc.png') }}" width="100px" alt="{{ config('app.title') }}">
                                </a>
                                <p class="lead font-weight-bold">@yield('formHeading', config('app.title'))</p>
                            </div>
                            <div class="body">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </body>
</html>
