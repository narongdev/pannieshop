<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>PANNIE SHOP - Admin Login</title>
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}" />        
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/styles.css') }}">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

        <!-- WYSIWYG Summernote -->
        <link rel="stylesheet" href="{{ asset('assets/editor/summernote-bs4.css') }}">
        <script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.5/umd/popper.js"></script>
        
    </head>
    <body class="sb-nav-fixed">
        
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-success">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{ route('dashboard')}}">Senior Shop</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                
            </div>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user fa-fw"></i> {{ session('ssFullname') }}</a>
                    <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Profile</a></li>
                        <li><a class="dropdown-item" href="#!">Change Password</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
            
            
        </nav>
        <div id="layoutSidenav">
            @include('backend.layout.nav')

            <div id="layoutSidenav_content">
                
                
