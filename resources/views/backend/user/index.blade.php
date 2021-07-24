@include('backend.layout.header')           
           
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">User</li>
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
                        <div>
                        <button type="button" class="btn btn-sm btn-success" onclick="window.location.href='{{ route('useradd') }}'"><i class="fas fa-plus-circle"></i> Add New</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <select id="filter" class="form-control">
                                <option value="all" @if (Request::segment(4)=='all') selected @endif >Type : All</option>
                                <option value="admin" @if (Request::segment(4)=='admin') selected @endif >Type : Admin</option>
                                <option value="employee" @if (Request::segment(4)=='employee') selected @endif >Type : Employee</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" width="120">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Status</th>
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
                                @foreach($users as $row)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>{{ $row->username }}</td>
                                    <td>{{ $row->firstname.' '.$row->lastname }}</td>
                                    <td>{{ $row->usertype }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td class="center">
                                        @if($row->status=='enable')
                                        <i class="fas fa-check-circle" style="color:green"></i> Enable
                                        @else
                                        <i class="fas fa-times-circle" style="color:gray"></i> Disable
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/backend/user/show/'.$row->id) }}" title="Show" class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i></a>
                                        <a href="{{ url('/backend/user/edit/'.$row->id) }}" title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a data-href="{{ url('/backend/user/delete/'.$row->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" title="Delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    {!! $users->links() !!}
                </div>
            </div>

        </div>
    </main>

@include('backend.layout.footer')
@include('backend.user.scripts')