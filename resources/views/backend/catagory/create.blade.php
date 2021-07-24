@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Catagory</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Catagory</li>
                <li class="breadcrumb-item active">Add Catagory</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('catagory') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ route('catagorystore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xl-4 col-lg-4">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Image
                                </div>
                                <div class="card-body">
                                        <div class="result">
                                            @if(Session::get('fail'))
                                            <div class="alert alert-danger">{{ Session::get('fail')}}</div>
                                            @endif
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputFirst">Catagory Image</label>
                                            <input class="form-control" type="file" id="formFile" name="image" accept="image/*" onchange="previewImg(this)">
                                            <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                                        </div>
                                        <div id="preview" class="mt-2"></div>

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
                                            <label class="small mb-1" for="inputCat">Catagory</label>
                                            <input class="form-control" name="catagory" id="inputCat" type="text" value="{{ old('catagory') }}" />
                                            <span class="text-danger">@error('catagory') {{ $message }} @enderror</span>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputDesc">Description</label>
                                            <textarea class="form-control" name="description" id="inputDesc" rows="3">{{ old('description') }}</textarea>
                                            <span class="text-danger">@error('description') {{ $message }} @enderror</span>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputRec">Recommend</label>
                                                <select class="form-control" id="inputRec" name="recommend">
                                                    <option value="Y">Y</option>
                                                    <option value="N" selected>N</option>
                                                </select>
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
                    <a class="btn btn-sm btn-secondary" href="{{ route('catagory') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitADD();" ><i class="fas fa-save"></i> Save</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.catagory.scripts')