<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>PANNIE SHOP : Shopping online at home</title>
    <meta charset="utf-8">
    <meta name="Description" content="Shopping online website for everyone">
    <meta name="google-site-verification" content="+nxGUDJ4QpAZ5l9Bsjdi102tLVC21AIh5d1Nl23908vVuFHs34="/>
    <meta name="robots" content="noindex,nofollow">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('assets/webstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/carousel.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="/">PANNIE SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav me-auto mb-2 mb-lg-0">
                    
                </div>
                <form class="d-flex">
                    <input class="me-2" type="text" placeholder="Search" aria-label="Search">
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        @if (session('sessionMember'))
                        <a class="nav-link" href="{{ url('/account') }}">MY ACCOUNT</a>
                        @else
                        <a class="nav-link" href="{{ url('/register') }}">LOGIN | REGISTER</a>
                        @endif
                        
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/cart')}}"><i class="fas fa-shopping-cart"></i>
                            <span class='badge badge-warning' id='lblCartCount'>{{session('sessionCart')}}</span> </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

