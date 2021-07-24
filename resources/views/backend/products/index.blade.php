@include('backend.layout.header')           
           
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Products</h1> 
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Products</li>
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
                        
                        <a class="btn btn-sm btn-success" href="{{ route('productsadd') }}" ><i class="fas fa-plus-circle"></i> Add New</a>
                        <div class="d-flex justify-content-end">
                        <select id="catagory" class="form-control" style="margin-right: 10px">
                            <option value="all" @if (Request::segment(4)=='all') selected @endif >Catagory : All</option>
                            @foreach ($catagory as $item)
                            <option value="{{$item->id}}" @if (Request::segment(4)==$item->id) selected @endif >Catagory : {{$item->catagory}}</option>
                            @endforeach
                        </select>
                        <select id="filter" class="form-control">
                            <option value="all" @if (Request::segment(4)=='all') selected @endif >Recommend : All</option>
                            <option value="Y" @if (Request::segment(4)=='Y') selected @endif >Recommend : Y</option>
                            <option value="N" @if (Request::segment(4)=='N') selected @endif >Recommend : N</option>
                        </select>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col" width="60">No</th>
                                    <th scope="col" width="120">Image</th>
                                    <th scope="col">Products</th>
                                    <th scope="col" width="100" style="text-align: right">Price</th>
                                    <th scope="col" width="100" style="text-align: right">Stock</th>
                                    <th scope="col" width="100">Recommend</th>
                                    <th scope="col" width="100">Status</th>
                                    <th scope="col" width="120">Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Products</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Recommend</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @php
                                    $pageSize = 10;
                                    $pageNo = Request::query('page') ? Request::query('page') : 1;
                                    $Start = ($pageNo*$pageSize)-$pageSize+1;
                                    $i = $Start;
                                    if($i==0) $i = 1;
                                @endphp
                                @foreach($products as $row)
                                <tr>
                                    <th scope="row">{{$i++}}</th>
                                    <td>
                                        @if ($row->image)
                                        <img src="{{ asset($row->image)}}" width="120" />
                                        @endif
                                    </td>
                                    <td>
                                        {{ $row->products }}
                                        <p class="small">({{ \App\Models\Product::getCatName($row->catagory) }})</p>
                                    </td>
                                    <td style="text-align: right">{{ number_format($row->price,2) }}</td>
                                    <td style="text-align: right">{{ $row->stock }}</td>
                                    <td>{{ $row->recommend }}</td>
                                    <td class="center">
                                        @if($row->status=='enable')
                                        <i class="fas fa-check-circle" style="color:green"></i> Enable
                                        @else
                                        <i class="fas fa-times-circle" style="color:gray"></i> Disable
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('/backend/products/show/'.$row->id) }}" title="Show" class="btn btn-info btn-sm"><i class="fas fa-file-alt"></i></a>
                                        <a href="{{ url('/backend/products/edit/'.$row->id) }}" title="Edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a data-href="{{ url('/backend/products/delete/'.$row->id) }}" data-bs-toggle="modal" data-bs-target="#confirm-delete" title="Delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    {!! $products->links() !!}
                </div>
            </div>

        </div>
    </main>

@include('backend.layout.footer')
@include('backend.products.scripts')