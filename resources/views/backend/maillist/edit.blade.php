@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Maillist</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Maillist</li>
                <li class="breadcrumb-item active">Edit Maillist</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('maillist') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ url('/backend/maillist/update/'.$maillist->id) }}" method="post" enctype="multipart/form-data">
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
                                        
                                        <div class="form-group mb-3">
                                            <label class="small mb-1" for="inputEmail">Email </label>
                                            <input class="form-control" name="email" id="inputEmail" type="text" value="{{ $maillist->email }}" />
                                            <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                        </div>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                    </form>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a class="btn btn-sm btn-secondary" href="{{ route('maillist') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitEDIT();" ><i class="fas fa-save"></i> Update</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.maillist.scripts')