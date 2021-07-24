@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Products</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Products</li>
                <li class="breadcrumb-item active">Edit Products</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('products') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ url('/backend/products/update/'.$products->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xl-4 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Image
                                </div>
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label class="small mb-1" for="inputFirst">Products Image</label>
                                        <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="previewImg(this)">
                                        <span class="text-danger">@error('image') {{ $message }} @enderror</span>
                                    </div>
                                    <div id="preview" class="mt-2">
                                    @if ($products->image)
                                    <img src="{{ asset($products->image)}}" width="100%" />
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Information
                                </div>
                                <div class="card-body">
                                        
                                        <div class="form-group mb-3">
                                                <label class="small mb-1" for="inputCat">Products</label>
                                                <input type="text" class="form-control" name="products" id="inputCat" value="{{ $products->products }}">
                                        </div>
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputDesc">Description</label>
                                                <textarea class="form-control" name="description" id="inputDesc" rows="5">{{ $products->description }}</textarea>
                                                <span class="text-danger">@error('description') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputCat">Catagory</label>
                                                @php
                                                    $ArrCat = explode(",",$products->catagory);
                                                @endphp
                                                @foreach ($catagory as $row)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="catagory[]" @if (in_array($row->id,$ArrCat)) checked @endif value="{{$row->id}}" id="cat{{$row->id}}">
                                                        <label class="form-check-label" for="cat{{$row->id}}">
                                                        {{$row->catagory}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputPrice">Price</label>
                                                <input class="form-control" name="price" id="inputPrice" type="number" value="{{ $products->price }}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStock">Stock</label>
                                                <input class="form-control" name="stock" id="inputStock" type="number" value="{{ $products->stock }}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputRec">Recommend</label>
                                                <select class="form-control" id="inputRec" name="recommend">
                                                    <option value="Y" @if($products->recommend=='Y') {{'selected="selected"'}} @endif>Y</option>
                                                    <option value="N" @if($products->recommend=='N') {{'selected="selected"'}} @endif>N</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <select class="form-control" id="inputStatus" name="status">
                                                    <option value="enable" @if($products->status=='enable') {{'selected="selected"'}} @endif >Enable</option>
                                                    <option value="disable" @if($products->status=='disable') {{'selected="selected"'}} @endif>Disable</option>
                                                </select>
                                            </div>
                                        </div>

                                              
                                        
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="form-group mb-3">
                            <label class="small mb-1" for="inputFea">Feature</label>
                            <textarea class="form-control summernote" name="feature" id="inputFea" rows="7">{{ $products->feature }}</textarea>
                            <span class="text-danger">@error('feature') {{ $message }} @enderror</span>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('products') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitEDIT();" ><i class="fas fa-save"></i> Update</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.products.scripts')