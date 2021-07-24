@include('frontend.layout.header') 

<section id="catagory_bar">
    <ul class="catagory_top text-center">
        @foreach ($Catagory as $item)
            <li><a href="{{ url('catagory').'/'.$item->id }}">{{ $item->catagory }}</a></li>
        @endforeach        
    </ul>
</section>

<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item" aria-current="page">Home</li>
          <li class="breadcrumb-item">Catagory</li>
          <li class="breadcrumb-item active">Product</li>
        </ol>
    </nav>
</div>

<section id="product_detail">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset($Products->image)}}" alt="{{ $Products->products }}" width="100%">
            </div>
            <div class="col-md-5">
                <h1>{{ $Products->products }}</h1>
                <p class="price">{{ number_format($Products->price,2) }}</p>
                <p>{{ $Products->description }}</p>
                <div class="small">In Stack : <span id="inStock">{{ $Products->stock }}</span></div>
                <div class="d-flex mt-3">
                    <a href="javascript:minusQTY(document.getElementById('QTY'))" class="btn btn-sm btn-light mr-3"><i class="fas fa-minus-circle"></i></a>
                    <input type="number" id="QTY" value="1">
                    <a href="javascript:plusQTY(document.getElementById('QTY'))" class="btn btn-sm btn-light mr-3"><i class="fas fa-plus-circle"></i></a>
                    <a href="javascript:addToCart({{$Products->id}},document.getElementById('QTY').value)" class="btn btn-sm btn-warning ml-3"> <i class="fas fa-shopping-cart"></i> Add to cart</a>
                </div>
                
            </div>
            <div class="col-md-3 d-none d-md-block d-lg-block d-xl-block d-xxl-block mt-3">
                <h4>Recent Products</h4>
                @foreach ($Recent as $item)
                <div class="row mb-2">
                    <div class="col-sm-12 col-md-4">
                        <img src="{{ asset($item->image)}}" alt="{{ $item->products }}" width="100%">
                    </div>
                    <div class="col-sm-12 col-md-8">   
                        <div class="product_name">
                            <a href="{{ url('products').'/'.$item->id }}">{{ $item->products }}</a>
                        </div>
                        <div class="price">
                            {{ number_format($item->price,2) }}
                        </div>
                    </div> 
                </div>
                @endforeach
            </div>
        </div>
        <br /><br />
        <div class="row">
            <h4>Feature</h4>
            <p>{!! $Products->feature !!}</p>
        </div>
    </div>
</section>

<section id="relate">
    <div class="container">
        <div class="row">
            <h4>Related Products</h4>
            @foreach ($Relate as $item)
            <div class="col-xs-12 col-sm-4 col-md-3">
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
            @endforeach
        </div>
    </div>
</section>
<script>

////////////// Add to Cart in Product detail page //////////
var inStock = Number(document.getElementById('inStock').innerHTML);
var QTY = document.getElementById('QTY');
QTY.onchange = function(){

    if(this.value >= inStock){
        this.value = inStock;
        return false;
    }
    if(this.value <= 1){
        this.value = 1;
    }
};
QTY.onkeyup = function(){

    if(this.value >= inStock){
        this.value = inStock;
        return false;
    }
    if(this.value <= 1){
        this.value = 1;
    }
};

var minusQTY = (Obj)=>{
    if(Obj.value <= 1 ){
        Obj.value = 1;
        return false;
    } 
    Obj.value = Number(Obj.value) - 1;
}
var plusQTY = (Obj)=>{
    if(Obj.value >= inStock){
        Obj.value = inStock;
        return false;
    }
    Obj.value = Number(Obj.value) + 1;
}
</script>
@include('frontend.layout.footer') 