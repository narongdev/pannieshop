@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Order</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Order</li>
                <li class="breadcrumb-item active">Add Order</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('order') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ route('orderstore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Information
                                </div>
                                <div class="card-body">
                                        <div class="result">
                                            @if(Session::get('fail'))
                                            <div class="alert alert-danger">{{ Session::get('fail')}}</div>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputMem">Customer Name</label>
                                            <input class="form-control" name="member" id="inputMem" type="text" value="{{ old('member') }}" />
                                            <span class="text-danger">@error('member') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputMobile">Mobile</label>
                                            <input class="form-control" name="mobile" id="inputMobile" type="text" value="{{ old('mobile') }}" />
                                            <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control" name="email" id="inputEmail" type="email" value="{{ old('email') }}" />
                                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputAdd">Address</label>
                                            <textarea class="form-control" name="address" id="inputAdd" rows="3">{{ old('address') }}</textarea>
                                            <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPost">Post Code</label>
                                                <input class="form-control" name="postcode" id="inputPost" maxlength="5" type="text" value="{{ old('postcode') }}" />
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Order 
                                </div>
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputAmount">Amount</label>
                                            <input class="form-control" name="amount" id="inputAmount" type="number" value="{{ old('amount') }}" />
                                            <span class="text-danger">@error('amount') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputStatus">Payment Status</label>
                                            <select class="form-control" id="inputStatus" name="payment">
                                                <option value="new">New</option>
                                                <option value="paid">paid</option>
                                                <option value="cancel">cancel</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="small mb-1" for="inputProducts">Products</label>
                                        <input class="form-control" name="products" id="inputProducts" type="text" value="{{ old('products') }}" />
                                        <span class="text-danger">@error('products') {{ $message }} @enderror</span>
                                    </div>
                                    
                                    
                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('order') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitADD();" ><i class="fas fa-save"></i> Save</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.order.scripts')