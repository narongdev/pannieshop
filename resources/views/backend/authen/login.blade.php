<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Backend - Admin Login</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-info">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container my-5">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Login</h3></div>
                                    <div class="card-body">
                                        <form id="frmLogin" action="{{ route('authen') }}" method="post">
                                            @csrf
                                            <div class="result">
                                                @if(Session::get('fail'))
                                                <div class="alert alert-danger">{{ Session::get('fail')}}</div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputUsername">Username</label>
                                                <input class="form-control" id="inputUsername" name="username" type="input" placeholder="Enter Username" value="{{ old('username') }}" />
                                                <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control" id="inputPassword" name="password" type="password" placeholder="Enter password" />
                                                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <!-- <a class="small" href="password.html">Forgot Password?</a> -->
                                                <button type="submit" class="btn btn-success"> <i class="fas fa-key"></i> Login </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
</html>
