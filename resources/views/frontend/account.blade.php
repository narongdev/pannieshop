@include('frontend.layout.header')
<section id="checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2>Information</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('information') }}" id="frmInfo" method="POST">
                            @csrf   
                            
                            <input type="hidden" name="memberid" value="{{ $Member->id }}">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">First Name</label> <span class="red">*</span>
                                    <input class="form-control" name="firstname" type="text" value="{{ $Member->firstname }}" />
                                    <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Last Name</label> <span class="red">*</span>
                                    <input class="form-control" name="lastname" type="text" value="{{ $Member->lastname }}" />
                                    <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1">Street Address</label> <span class="red">*</span>
                                <input class="form-control" name="address" type="text" value="{{ $Member->address }}" />
                                <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">city</label> <span class="red">*</span>
                                    <input class="form-control" name="city" type="text" value="{{ $Member->city }}" />
                                    <span class="text-danger">@error('city') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">State</label> <span class="red">*</span>
                                    <input class="form-control" name="state" type="text" value="{{ $Member->state }}" />
                                    <span class="text-danger">@error('state') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Zip</label> <span class="red">*</span>
                                    <input class="form-control" name="zip" type="text" value="{{ $Member->zip }}" />
                                    <span class="text-danger">@error('zip') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Phone</label> <span class="red">*</span>
                                    <input class="form-control" name="phone" type="text" value="{{ $Member->phone }}" />
                                    <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1">Email</label> <span class="red">*</span>
                                <input class="form-control" name="email" readonly type="email" value="{{ $Member->email }}" />
                                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                            </div>
                            <button type="submit" class="btn btn-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <h2>My Account</h2>
                <div class="card">
                    <div class="card-body">
                        <h5>Welcome : {{ $Member->firstname.' '.$Member->lastname }}</h5>
                        <a href="/logout" class="btn btn-sm btn-danger">Log out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.layout.footer')