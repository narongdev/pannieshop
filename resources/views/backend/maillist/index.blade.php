@include('backend.layout.header')           
           
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Maillist</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Maillist</li>
            </ol>

            <div class="result">
                @if(Session::get('success'))
                <div class="alert alert-success">{{ Session::get('success')}}</div>
                @endif
                @if(Session::get('danger'))
                <div class="alert alert-danger">{{ Session::get('danger')}}</div>
                @endif
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        
                        <a class="btn btn-sm btn-success" href="{{ route('maillistadd') }}" ><i class="fas fa-plus-circle"></i> Add New</a>
                        <div class="d-flex justify-content-end">
                            <input type="text" id="search" class="form-control" placeholder="Search ...">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col" width="60">No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" width="120">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $pageSize = 15;
                                    $pageNo = Request::query('page') ? Request::query('page') : 1;
                                    $Start = ($pageNo*$pageSize)-$pageSize+1;
                                    $i = $Start;
                                    if($i==0) $i = 1;
                                @endphp
                                @foreach($maillist as $row)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $row->email }}</td>
                                    <td>
                                        <a href="{{ url('/backend/maillist/edit/'.$row->id) }}" title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a data-href="{{ url('/backend/maillist/delete/'.$row->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" title="Delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    {!! $maillist->links() !!}
                </div>
            </div>

        </div>
    </main>

@include('backend.layout.footer')
@include('backend.maillist.scripts')