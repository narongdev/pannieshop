@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Member</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Member</li>
                <li class="breadcrumb-item active">Edit Member</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('member') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ url('/backend/member/update/'.$member->id) }}" method="post" enctype="multipart/form-data">
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
                                            <label class="small mb-1" for="inputFirst">First Name</label>
                                            <input class="form-control" name="firstname" id="inputFirst" type="text" value="{{ $member->firstname }}" />
                                            <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputLast">Last Name</label>
                                            <input class="form-control" name="lastname" id="inputLast" type="text" value="{{ $member->lastname }}" />
                                            <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputMobile">Phone</label>
                                            <input class="form-control" name="phone" id="inputMobile" type="text" value="{{ $member->phone }}" />
                                            <span class="text-danger">@error('phone') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control" name="email" readonly id="inputEmail" type="email" value="{{ $member->email }}" />
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
                                            <textarea class="form-control" name="address" id="inputAdd" rows="2">{{ $member->address }}</textarea>
                                            <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputCity">City</label>
                                                <input class="form-control" name="city" id="inputCity" type="text" value="{{ $member->city }}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputState">State</label>
                                                <input class="form-control" name="state" id="inputState" type="text" value="{{ $member->state }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPost">Zip</label>
                                                <input class="form-control" name="zip" id="inputPost" type="text" value="{{ $member->zip }}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <select class="form-control" id="inputStatus" name="status">
                                                    <option value="enable" @if($member->status=='enable') {{'selected="selected"'}} @endif >Enable</option>
                                                    <option value="disable" @if($member->status=='disable') {{'selected="selected"'}} @endif>Disable</option>
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
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitEDIT();" ><i class="fas fa-save"></i> Update</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.member.scripts')