@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Catagory</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Catagory</li>
                <li class="breadcrumb-item active">Catagory Detail</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('catagory') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Image
                                </div>
                                <div class="card-body">
                                        
                                    @if ($catagory->image)
                                    <img src="{{ asset($catagory->image)}}" width="100%" />
                                    @endif
                                        
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Information
                                </div>
                                <div class="card-body">
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputCatagory">Catagory</label>
                                            <p>{{ $catagory->catagory }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputDesc">Description</label>
                                            <p>{{ $catagory->description }}</p>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputRec">Recommend</label>
                                                <p>{{ $catagory->recommend }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <p style="text-transform: capitalize;">{{ $catagory->status }}</p>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('catagory') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <div>
                        <a class="btn btn-sm btn-success " href="{{ url('/backend/catagory/edit/'.$catagory->id) }}" ><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-danger " data-href="{{ url('/backend/catagory/delete/'.$catagory->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" ><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>

            </div>  

        </div>

    </main>
@include('backend.layout.footer')
@include('backend.catagory.scripts')