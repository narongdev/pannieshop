@include('frontend.layout.header')
<section id="checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>My Account</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <h4>LOGIN</h4>
                                @if(Session::get('fail'))
                                <div class="alert alert-danger">{{ Session::get('fail')}}</div>
                                @endif
                                <form id="frmLogin" action="{{ url('/login') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="small mb-1">Email</label> <span class="red">*</span>
                                        <input class="form-control" name="lemail" type="email" value="{{ old('lemail') }}" />
                                        <span class="text-danger">@error('lemail') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="small mb-1">Password</label> <span class="red">*</span>
                                        <input class="form-control" name="lpassword" type="password" value="{{ old('lpassword') }}" />
                                        <span class="text-danger">@error('lpassword') {{ $message }} @enderror</span>
                                    </div>
                                    <button type="submit" class="btn btn-success"> Log in</button>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-5">
                                <h4>REGISTER</h4>
                                <form id="frmRegister" action="{{ url('/register') }}" method="POST">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="small mb-1">Email</label> <span class="red">*</span>
                                        <input class="form-control" name="email" type="email" value="{{ old('email') }}" />
                                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="small mb-1">Password</label> <span class="red">*</span>
                                        <input class="form-control" name="password" type="password" value="{{ old('password') }}" />
                                        <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                    </div>
                                    <button type="submit" class="btn btn-success"> Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.layout.footer')