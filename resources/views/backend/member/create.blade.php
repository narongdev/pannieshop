@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Member</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Member</li>
                <li class="breadcrumb-item active">Add Member</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('member') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ route('memberstore') }}" method="post" enctype="multipart/form-data">
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
                                            <label class="small mb-1" for="inputMem">First Name</label>
                                            <input class="form-control" name="firstname" id="inputMem" type="text" value="{{ old('firstname') }}" />
                                            <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputLast">Last Name</label>
                                            <input class="form-control" name="lastname" id="inputLast" type="text" value="{{ old('lastname') }}" />
                                            <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputMobile">Phone</label>
                                            <input class="form-control" name="phone" id="inputMobile" type="text" value="{{ old('phone') }}" />
                                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control" name="email" id="inputEmail" type="email" value="{{ old('email') }}" />
                                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                        </div>
                                        

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Address 
                                </div>
                                <div class="card-body">

                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputAdd">Address</label>
                                            <textarea class="form-control" name="address" id="inputAdd" rows="2">{{ old('address') }}</textarea>
                                            <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputCity">City</label>
                                                <input class="form-control" name="city" id="inputCity" type="text" value="{{ old('city') }}" />
                                                <span class="text-danger">@error('city') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputState">State</label>
                                                <input class="form-control" name="state" id="inputState" type="text" value="{{ old('state') }}" />
                                                <span class="text-danger">@error('state') {{ $message }} @enderror</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputZip">Zip</label>
                                                <input class="form-control" name="zip" id="inputZip" maxlength="10" type="text" value="{{ old('zip') }}" />
                                                <span class="text-danger">@error('zip') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <select class="form-control" id="inputStatus" name="status">
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('member') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitADD();" ><i class="fas fa-save"></i> Save</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.member.scripts')