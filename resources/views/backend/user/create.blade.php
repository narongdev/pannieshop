@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">Add User</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('user') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ route('userstore') }}" method="post" enctype="multipart/form-data">
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
                                            <input class="form-control" name="firstname" id="inputFirst" type="text" placeholder="" value="{{ old('firstname') }}" />
                                            <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputLast">Last Name</label>
                                            <input class="form-control" name="lastname" id="inputLast" type="text" placeholder="" value="{{ old('lastname') }}" />
                                            <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input class="form-control" name="email" id="inputEmail" type="email" placeholder="" value="{{ old('email') }}" />
                                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Login 
                                </div>
                                <div class="card-body">
                                    
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputUser">User Name</label>
                                                <input class="form-control" name="username" id="inputUser" type="text" placeholder="" value="{{ old('username') }}" />
                                                <span class="text-danger">@error('username') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputType">User Type</label>
                                                <select class="form-control" id="inputType" name="usertype">
                                                    <option value="admin">Admin</option>
                                                    <option value="employee" selected>Employee</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPass">Password</label>
                                                <input class="form-control" name="password" id="inputPass" type="password" placeholder="" value="{{ old('repassword') }}" />
                                                <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPass2">Re-Password</label>
                                                <input class="form-control" name="repassword" id="inputPass2" type="password" placeholder="" value="{{ old('repassword') }}" />
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-3">
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
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('user') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitADD();" ><i class="fas fa-save"></i> Save</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.user.scripts')