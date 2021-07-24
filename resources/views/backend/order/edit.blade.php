@include('backend.layout.header')            
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Order</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item">Order</li>
                <li class="breadcrumb-item active">Edit Order</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a class="btn btn-sm btn-secondary" href="{{ route('order') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                </div>
                <div class="card-body">
                    <form id="frmInfor" action="{{ url('/backend/order/update/'.$order->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        
                        <div class="col-xl-6 col-lg-6">
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
                                        <label class="small mb-1" for="inputMem">Customer Name</label>
                                        <p>{{ $order->firstname.' '.$order->lastname }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="small mb-1" for="inputMobile">Phone</label>
                                        <p>{{ $order->phone }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="small mb-1" for="inputEmail">Email</label>
                                        <p>{{ $order->email }}</p>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="small mb-1" for="inputAdd">Address</label>
                                        <p>{{ $order->address }}</p>
                                        <p>{{ $order->city }}</p>
                                        <p>{{ $order->state }}</p>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPost">Zip</label>
                                            <p>{{ $order->zip }}</p>
                                        </div>
                                        
                                    </div>
                                    

                            </div>
                        </div>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Order 
                                </div>
                                <div class="card-body">
                                        
                                    <div class="form-group mb-3">
                                        <label class="small mb-1" >Order No</label>
                                        <p>{{ $order->orderno }}</p>
                                    </div>

                                    <div class="form-group mb-3">
                                        @if ($products)
                                        <table class="table table-secondary">
                                            <thead>
                                                <th>Items</th>
                                                <th style="text-align: right;">Unit Price</th>
                                                <th style="text-align: right;">Qty</th>
                                                <th style="text-align: right;">Total Price</th>
                                            </thead>
                                            <tbody>
                                            @foreach ($products as $row)
                                                <tr>
                                                    <td>{{ $row->products }}</td>
                                                    <td style="text-align: right;">{{ number_format($row->unitprice,2) }}</td>
                                                    <td style="text-align: right;">{{ $row->qty }}</td>
                                                    <td style="text-align: right;">{{ number_format($row->totalprice,2) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputPost">Amount</label>
                                            <p>{{ number_format($order->amount,2) }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="small mb-1" for="inputStatus">Payment Status</label>
                                            <select class="form-control" id="inputStatus" name="payment">
                                                <option value="new" @if($order->payment=='new') {{'selected="selected"'}} @endif >New</option>
                                                <option value="paid" @if($order->payment=='paid') {{'selected="selected"'}} @endif>Paid</option>
                                                <option value="cancel" @if($order->payment=='cancel') {{'selected="selected"'}} @endif>Cancel</option>
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
                    <a class="btn btn-sm btn-secondary" href="{{ route('order') }}" ><i class="fas fa-arrow-circle-left"></i> Cancel</a>
                    <a class="btn btn-sm btn-success" href="javascript:beforeSubmitEDIT();" ><i class="fas fa-save"></i> Update Payment Status</a>
                </div>
            </div>

        </div>
    </main>
@include('backend.layout.footer')
@include('backend.order.scripts')
