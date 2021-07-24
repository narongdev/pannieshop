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
<h1 style="display: none">PANNIE SHOP : Best shopping online for everyone</h1>

<section id="promotion">
    <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @php
                $i = 1;
            @endphp
            @foreach ($Promotion as $item)
                <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="{{$i}}" @if($i==1) class="active" aria-current="true" @endif aria-label="Slide {{$i}}"></button>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
        <div class="carousel-inner">
            @php
                $i = 1;
            @endphp
            @foreach ($Promotion as $item)
            <div class="carousel-item @if($i==1) active @endif">
                <div class="container">
                    {!!$item->content!!}
                </div>
            </div>
            @php
                $i++;
            @endphp
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section id="recommend">
    <div class="container">
        <h3>Products Recommend</h3>
        <div class="row">
            @foreach ($RecomProduct as $item)
            <div class="col-sm-6 col-md-3 mb-3">
                <a href="{{ url('products').'/'.$item->id }}"><img src="{{ asset($item->image)}}" alt="{{ $item->products }}" width="100%"></a>
                <div class="block_product">   
                    <div class="small">{{ \App\Models\Product::getCatName($item->catagory) }}</div>
                    <div class="product_name">
                        {{ $item->products }}
                    </div>
                    <div class="price">
                        {{ number_format($item->price,2) }}
                    </div>
                </div> 
            </div>
            @endforeach
            @foreach ($TopSaleProduct as $item)
            <div class="col-sm-6 col-md-3 mb-3">
                <a href="{{ url('products').'/'.$item->id }}"><img src="{{ asset($item->image)}}" alt="{{ $item->products }}" width="100%"></a>
                <div class="block_product">   
                    <div class="small">{{ \App\Models\Product::getCatName($item->catagory) }}</div>
                    <div class="product_name">
                        {{ $item->products }}
                    </div>
                    <div class="price">
                        {{ number_format($item->price,2) }}
                    </div>
                </div> 
            </div>
            @endforeach
            @foreach ($RecomProductRemain as $item)
            <div class="col-sm-6 col-md-3 mb-3">
                <a href="{{ url('products').'/'.$item->id }}"><img src="{{ asset($item->image)}}" alt="{{ $item->products }}" width="100%"></a>
                <div class="block_product">   
                    <div class="small">{{ \App\Models\Product::getCatName($item->catagory) }}</div>
                    <div class="product_name">
                        {{ $item->products }}
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

<section id="catagory">
    <h3>Featured Collections</h3>
    <div class="container">
        <div class="row">
            @foreach ($RecomCatagory as $item)
            <div class="col-md-4">
                <a href="{{ url('catagory').'/'.$item->id }}"><img src="{{ asset($item->image)}}" alt="{{ $item->catagory }}" width="100%"></a>
                <div class="block_catagory">   
                    <div class="catagory_name">
                        <a href="{{ url('catagory').'/'.$item->id }}">{{ $item->catagory }}</a>
                    </div>
                    <div class="small">{{ $item->description }}</div>
                    <div class="buy_now">
                        <a href="{{ url('catagory').'/'.$item->id }}" class="btn btn-sm btn-warning">SHOP NOW</a>
                    </div>
                </div> 
            </div>
            @endforeach
            @foreach ($TopSaleCatagory as $item)
            <div class="col-md-4">
                <a href="{{ url('catagory').'/'.$item->id }}"><img src="{{ asset($item->image)}}" alt="{{ $item->catagory }}" width="100%"></a>
                <div class="block_catagory">   
                    <div class="catagory_name">
                        <a href="{{ url('catagory').'/'.$item->id }}">{{ $item->catagory }}</a>
                    </div>
                    <div class="small">{{ $item->description }}</div>
                    <div class="buy_now">
                        <a href="{{ url('catagory').'/'.$item->id }}" class="btn btn-sm btn-warning">SHOP NOW</a>
                    </div>
                </div> 
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="trending">
    <div class="container">
        <h3>Trending Catagories</h3>
        <p class="trender">
            @foreach ($TopClickCatagory as $item)
                <a href="{{ url('catagory').'/'.$item->id }}"><span class="badge bg-info text-dark">{{ $item->catagory }}</span></a>
            @endforeach
        </p>
        
    </div>
</section>

<section id="subcribe">
    <div class="container">
        <div class="subscribe">
            <div>Subscribe now to get notified about exclusive offer</div>
            <div><input type="text" id="email"></div>
            <div><button class="btn btn-sm btn-danger" onclick="addSubscribe()">Subscribe</button></div>
        </div>
    </div>
</section>

@include('frontend.layout.footer') 