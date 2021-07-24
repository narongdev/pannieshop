@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Promotion</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Promotion</li>
                <li class="breadcrumb-item active">Add Promotion</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('promotion') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ route('promotionstore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xl-12 col-lg-12">
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
                                        
                                        <div class="row mb-3">
                                            <div class="col-md-8">
                                                <label class="small mb-1" for="inputPro">Promotion Name</label>
                                                <input class="form-control" name="promotion" id="inputPro" type="text" value="{{ old('promotion') }}" />
                                                <span class="text-danger">@error('promotion') {{ $message }} @enderror</span>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="small mb-1" for="inputStatus">Status</label>
                                                <select class="form-control" id="inputStatus" name="status">
                                                    <option value="enable">Enable</option>
                                                    <option value="disable">Disable</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputCon">Content</label>
                                            <textarea class="form-control summernote" name="content" id="inputCon" rows="5">{{ old('content') }}</textarea>
                                            <span class="text-danger">@error('content') {{ $message }} @enderror</span>
                                        </div>
                                        

                                </div>
                            </div>
                        </div>

                        
                    </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('promotion') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitADD();" ><i class="fas fa-save"></i> Save</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.promotion.scripts')