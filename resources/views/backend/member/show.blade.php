@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Member</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Member</li>
                <li class="breadcrumb-item active">Member Detail</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('member') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Information
                                </div>
                                <div class="card-body">
                                        
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputMem">First Name</label>
                                            <p>{{ $member->firstname }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputMem">Last Name</label>
                                            <p>{{ $member->lastname }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputMobile">Phone</label>
                                            <p>{{ $member->phone }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputEmail">Email</label>
                                            <p>{{ $member->email }}</p>
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
                                            <p>{{ $member->address }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputAdd">City</label>
                                            <p>{{ $member->city }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputAdd">State</label>
                                            <p>{{ $member->state }}</p>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPost">Zip</label>
                                                <p>{{ $member->zip }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <p style="text-transform: capitalize">{{ $member->status }}</p>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('member') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <div>
                        <a class="btn btn-sm btn-success " href="{{ url('/backend/member/edit/'.$member->id) }}" ><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-danger " data-href="{{ url('/backend/member/delete/'.$member->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" ><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>

            </div>  

        </div>

    </main>
@include('backend.layout.footer')
@include('backend.member.scripts')