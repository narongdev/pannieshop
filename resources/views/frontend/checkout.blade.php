@include('frontend.layout.header')
<section id="checkout">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h2>Billing Detail</h2>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('billing') }}" id="frmBilling" method="POST">
                            @csrf   
                            
                            @if ($Member)
                               
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
                            
                            @else
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">First Name</label> <span class="red">*</span>
                                    <input class="form-control" name="firstname" type="text" value="{{ old('firstname') }}" />
                                    <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Last Name</label> <span class="red">*</span>
                                    <input class="form-control" name="lastname" type="text" value="{{ old('lastname') }}" />
                                    <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1">Street Address</label> <span class="red">*</span>
                                <input class="form-control" name="address" type="text" value="{{ old('address') }}" />
                                <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">city</label> <span class="red">*</span>
                                    <input class="form-control" name="city" type="text" value="{{ old('city') }}" />
                                    <span class="text-danger">@error('city') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">State</label> <span class="red">*</span>
                                    <input class="form-control" name="state" type="text" value="{{ old('state') }}" />
                                    <span class="text-danger">@error('state') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="small mb-1">Zip</label> <span class="red">*</span>
                                    <input class="form-control" name="zip" type="text" value="{{ old('zip') }}" />
                                    <span class="text-danger">@error('zip') {{ $message }} @enderror</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1">Phone</label> <span class="red">*</span>
                                    <input class="form-control" name="phone" type="text" value="{{ old('phone') }}" />
                                    <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="small mb-1">Email</label> <span class="red">*</span>
                                <input class="form-control" name="email" type="email" value="{{ old('email') }}" />
                                <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                            </div>

                            @endif
                             
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <h2>Your Order</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline linespace">
                            <strong>Product</strong>
                            <strong>Sub Totals</strong>
                        </div>
                        @php
                            $Sum = 0;
                        @endphp
                        @foreach ($ProductsInCart as $item)                        
                        <div class="d-flex justify-content-between linespace">
                            <span>{{$item->products.' x '.$item->qty}}</span>
                            <span>{{ number_format($item->price*$item->qty,2) }}</span>
                            @php
                                $Sum = $Sum + ($item->price*$item->qty);
                            @endphp
                        </div>
                        @endforeach
                        <div class="d-flex justify-content-between linespace">
                            <strong>Totals</strong>
                            <strong>{{ number_format($Sum,2) }}</strong>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/cart') }}" class="btn btn-secondary mt-3"> Back to Shopping Cart</a>
                    <a href="javascript:;" onclick="document.getElementById('frmBilling').submit()" class="btn btn-success mt-3"> Place Order</a>
                </div>
            </div>
        </div>
    </div>
</section>
@include('frontend.layout.footer')