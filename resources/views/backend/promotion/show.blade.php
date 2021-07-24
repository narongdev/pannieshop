@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Promotion</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Promotion</li>
                <li class="breadcrumb-item active">Promotion Detail</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('promotion') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-xl-12 col-lg-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Information
                                </div>
                                <div class="card-body">
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-8">
                                                <label class="small mb-1" for="inputPro">Promotion Name</label>
                                                <p>{{ $promotion->promotion }}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <p style="text-transform: capitalize">{{ $promotion->status }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputCon">Content</label>
                                            <p>{!! $promotion->content !!}</p>
                                        </div>
                                        

                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('promotion') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <div>
                        <a class="btn btn-sm btn-success " href="{{ url('/backend/promotion/edit/'.$promotion->id) }}" ><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-danger " data-href="{{ url('/backend/promotion/delete/'.$promotion->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" ><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>

            </div>  

        </div>

    </main>
@include('backend.layout.footer')
@include('backend.promotion.scripts')