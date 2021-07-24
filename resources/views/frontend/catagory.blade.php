@include('frontend.layout.header')
<section id="catagory_bar">
    <ul class="catagory_top text-center">
        @foreach ($Catagory as $item)
            @if (Request::segment(2)==$item->id)
            <li class="active"><a href="{{ url('catagory').'/'.$item->id }}">{{ $item->catagory }}</a></li>
            @else
            <li><a href="{{ url('catagory').'/'.$item->id }}">{{ $item->catagory }}</a></li>
            @endif
        @endforeach        
    </ul>
</section>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">Home</li>
          <li class="breadcrumb-item active">Catagory</li>
        </ol>
    </nav>
</div>

<section id="list_product">
    <div class="container">
        <div class="row">
            <h1 class="mb-3">{{ $CatagoryName }}</h1>
            @foreach ($Products as $item)
            <div class="colproduct">
                <div class="col-md-12 mb-3">
                    <div class="block_img">
                        <div class="addcart">
                            <a href="javascript:addToCart({{$item->id}},1)" class="btn btn-sm btn-warning">Add to Cart</a>
                        </div>
                        <img src="{{ asset($item->image)}}" alt="{{ $item->products }}" width="100%">
                    </div>
                    <div class="block_product">   
                        <div class="small">{{ \App\Models\Product::getCatName($item->catagory) }}</div>
                        <div class="product_name">
                            <a href="{{ url('products').'/'.$item->id }}">{{ $item->products }}</a>
                        </div>
                        <div class="price">
                            {{ number_format($item->price,2) }}
                        </div>
                    </div> 
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>
<script>

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://127.0.0.1:8000/api/addclick');
    xhr.setRequestHeader ( "Content-type", "application/x-www-form-urlencoded" );
    xhr.responseType = 'json';
    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.response);
            }
        }
    };
    xhr.send("catagory={{Request::segment(2)}}");

</script>
@include('frontend.layout.footer')
