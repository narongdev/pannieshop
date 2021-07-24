@include('backend.layout.header')           
           
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Order</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Order</li>
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
                    <div class="d-flex justify-content-end">
                        
                        <!--<a class="btn btn-sm btn-success" href="{{ route('orderadd') }}" ><i class="fas fa-plus-circle"></i> Add New</a> -->
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
                                    <th scope="col" width="45">#</th>
                                    <th scope="col" width="130">Order No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" style="text-align: right">Amount</th>
                                    <th scope="col" width="120">Payment</th>
                                    <th scope="col" width="120">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order No</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" style="text-align: right">Amount</th>
                                    <th scope="col">Payment</th>
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
                                @foreach($order as $row)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{ $row->orderno }}</td>
                                    <td>{{ $row->firstname.' '.$row->lastname }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td style="text-align: right">{{ number_format($row->amount,2) }}</td>
                                    
                                    <td class="center">
                                        @if($row->payment=='paid')
                                        <i class="fas fa-check-circle" style="color:green"></i> Paid
                                        @elseif($row->payment=='new')
                                        <i class="fas fa-circle" style="color:lightblue"></i> New
                                        @else 
                                        <i class="fas fa-times-circle" style="color:red"></i> Cancel
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/backend/order/show/'.$row->id) }}" title="Show" class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i></a>
                                        @if($row->payment=='new')
                                        <a href="{{ url('/backend/order/edit/'.$row->id) }}" title="Payment" class="btn btn-warning btn-sm"><i class="fas fa-dollar-sign"></i></a>
                                        @endif
                                        <a data-href="{{ url('/backend/order/delete/'.$row->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" title="Delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    {!! $order->links() !!}
                </div>
            </div>

        </div>
    </main>

@include('backend.layout.footer')
@include('backend.order.scripts')