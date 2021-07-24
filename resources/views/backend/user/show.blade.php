@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">User Detail</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('user') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Information
                                </div>
                                <div class="card-body">
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputUser">First Name</label>
                                            <input type="text" disabled class="form-control-plaintext" value="{{ $users->firstname }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputLast">Last Name</label>
                                            <input type="text" disabled class="form-control-plaintext" value="{{ $users->lastname }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <input type="text" disabled class="form-control-plaintext" value="{{ $users->email }}">
                                        </div>
                                        
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Login
                                </div>
                                <div class="card-body">
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputUser">User Name</label>
                                                <input type="text" disabled class="form-control-plaintext" value="{{ $users->username }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputType">User Type</label>
                                                <input type="text" disabled class="form-control-plaintext" style="text-transform: capitalize;" value="{{ $users->usertype }}">
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputUser">Password</label>
                                            <input type="text" disabled class="form-control-plaintext" value="**********">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputYoutube">Status</label>
                                            <input type="text" disabled class="form-control-plaintext" style="text-transform: capitalize;" value="{{ $users->status }}">
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('user') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <div>
                        <a class="btn btn-sm btn-success " href="{{ url('/backend/user/edit/'.$users->id) }}" ><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-danger " data-href="{{ url('/backend/user/delete/'.$users->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" ><i class="fas fa-trash"></i> Delete</a>
                    </div>
                    </div>

            </div>  

        </div>

    </main>
@include('backend.layout.footer')
@include('backend.user.scripts')