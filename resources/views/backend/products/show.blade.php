@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Products</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Products</li>
                <li class="breadcrumb-item active">Products Detail</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('products') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
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
                                        
                                    @if ($products->image)
                                    <img src="{{ asset($products->image)}}" width="100%" />
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
                                            <label class="small mb-1" for="inputProducts">Products</label>
                                            <p>{{ $products->products }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputDesc">Description</label>
                                            <p>{{ $products->description }}</p>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" >Catagory</label>
                                            <p>{{ $catagory }}</p>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputRec">Price</label>
                                                <p>{{ $products->price }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStatus">Stock</label>
                                                <p>{{ $products->stock }}</p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputRec">Recommend</label>
                                                <p>{{ $products->recommend }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <p style="text-transform: capitalize;">{{ $products->status }}</p>
                                            </div>
                                        </div>
                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="inputFea">Feature</label>
                            <p>{!! $products->feature !!}</p>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('products') }}" ><i class="fas fa-arrow-circle-left"></i> Back</a>
                    <div>
                        <a class="btn btn-sm btn-success " href="{{ url('/backend/products/edit/'.$products->id) }}" ><i class="fas fa-edit"></i> Edit</a>
                        <a class="btn btn-sm btn-danger " data-href="{{ url('/backend/products/delete/'.$products->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" ><i class="fas fa-trash"></i> Delete</a>
                    </div>
                </div>

            </div>  

        </div>

    </main>
@include('backend.layout.footer')
@include('backend.products.scripts')