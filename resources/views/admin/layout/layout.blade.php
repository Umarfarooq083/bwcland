<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', config('app.title'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="description" content="BWC">
    <meta name="author" content="Blue World Resort">
    <link rel="icon" href="{{ url('admin/assets/images/bwc.png') }}" type="image/x-icon">

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/charts-c3/plugin.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/parsleyjs/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/dropify/css/dropify.min.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css">
    <link href="{{ url('admin/assets/lightbox/css/lightbox.min.css') }}" rel="stylesheet" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ url('admin/assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') }}">

    <!-- MAIN Project CSS file -->
    <link rel="stylesheet" href="{{ url('admin/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ url('admin/assets/css/imagecompresser.css') }}">
</head>

<body data-theme="light" class="font-nunito">
    <div id="wrapper" class="theme-cyan">

        <!-- Page Loader -->
        <div class="page-loader-wrapper font-18 cstm_loader" style="background:#0000007a;">
            <div class="loader">
                <div class="spinner-border text-white"></div>
                <p>Please wait...</p>
            </div>
        </div>


        @hasSection('content')
            @yield('content')
        @else
            <h2>No Content Found</h2>
        @endif

    </div>
@include('admin.layout.footer')
@yield('scripts')
