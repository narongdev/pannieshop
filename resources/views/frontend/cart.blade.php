@include('frontend.layout.header')
<section id="cart">
    <div class="container">
        @if (count($ProductsInCart) > 0)        
        <div class="row">
            <div class="col-md-8">
                <h2>Shopping Cart</h2>
                <table class="table table-light">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th style="text-align:right">Price</th>
                            <th style="text-align:right">Quantity</th>
                            <th style="text-align:right; width:120px">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $SubTotal = 0;
                        @endphp
                        @foreach ($ProductsInCart as $item)
                        <tr>
                            <td class="d-flex">
                                <div>
                                    <img src="{{ asset($item->image)}}" alt="{{ $item->products }}" width="60">
                                </div>
                                <div>
                                    <div>{{ $item->products }}</div>
                                    <div class="small">In Stock : {{$item->stock}}</div>
                                    <input type="hidden" class="ProID" value="{{$item->id}}">
                                </div>
                            </td>
                            <td style="text-align:right">
                                {{ number_format($item->price,2) }}
                                <input type="hidden" id="Price{{$item->id}}" value="{{$item->price}}">
                            </td>
                            <td style="text-align:right">
                                <a href="javascript:minusQTYCart({{$item->id}})" class="btn btn-sm btn-light mr-3"><i class="fas fa-minus-circle"></i></a>
                                <input type="text" class="inputQty" readonly id="QTY{{$item->id}}" value="{{ $item->qty }}">
                                <a href="javascript:plusQTYCart({{$item->id}},'{{$item->stock}}')" class="btn btn-sm btn-light mr-3"><i class="fas fa-plus-circle"></i></a>
                            </td>
                            <td style="text-align:right">
                                <input type="hidden" class="subtotal" id="Sum{{$item->id}}" value="{{$item->price*$item->qty}}">
                                <span id="SumTxt{{$item->id}}">{{ number_format($item->price*$item->qty,2) }}</span>
                                @php
                                    $SubTotal = $SubTotal + ($item->price*$item->qty);
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">
                <h2>Cart totals</h2>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-baseline linespace">
                            <span>Subtotals</span>
                            <span id="Subtotals">{{ number_format($SubTotal,2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between linespace">
                            <span>Tax</span>
                            <span>0.00</span>
                        </div>
                        <div class="d-flex justify-content-between linespace">
                            <span>Totals</span>
                            <span id="Totals">{{ number_format($SubTotal,2) }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ url('/clearcart') }}" class="btn btn-danger mt-3"> Clear Cart</a>
                    <a href="javascript:;" onclick="updateCart()" class="btn btn-success mt-3"> Process to checkout</a>
                </div>
            </div>
        </div>
        @else
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h4>Empty Cart</h4>
                        <a href="/">Go to Shopping</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
<script>

var minusQTYCart = (id)=>{
    var Obj = document.getElementById('QTY' + id);
    if(Obj.value <= 1 ){
        Obj.value = 1;
        return false;
    } 
    Obj.value = Number(Obj.value) - 1;
    // Total Price
    var price = document.getElementById('Price' + id).value;
    var total = Number(Obj.value) * price;
    document.getElementById('Sum' + id).value = total;
    document.getElementById('SumTxt' + id).innerHTML = total.toFixed(2);

    var Sum = 0;
    var Subtotal = document.getElementsByClassName("subtotal");
    for (var i = 0; i < Subtotal.length; i++) {
        Sum = Sum + Number(Subtotal.item(i).value);
    }
    document.getElementById('Subtotals').innerHTML = Sum.toFixed(2);
    document.getElementById('Totals').innerHTML = Sum.toFixed(2);
}
var plusQTYCart = (id,inStock)=>{
    var Obj = document.getElementById('QTY' + id);
    if(Number(Obj.value) >= Number(inStock)){
        Obj.value = inStock;
        return false;
    }
    Obj.value = Number(Obj.value) + 1;
    // Total Price
    var price = document.getElementById('Price' + id).value;
    var total = Number(Obj.value) * price;
    document.getElementById('Sum' + id).value = total;
    document.getElementById('SumTxt' + id).innerHTML = total.toFixed(2);

    var Sum = 0;
    var Subtotal = document.getElementsByClassName("subtotal");
    for (var i = 0; i < Subtotal.length; i++) {
        Sum = Sum + Number(Subtotal.item(i).value);
    }
    document.getElementById('Subtotals').innerHTML = Sum.toFixed(2);
    document.getElementById('Totals').innerHTML = Sum.toFixed(2);
}

var updateCart = ()=>{
    var ArrID = [];
    var Product = document.getElementsByClassName("ProID");
    for (var i = 0; i < Product.length; i++) {
        var qty = document.getElementById('QTY' + Product.item(i).value).value;
        ArrID.push(Product.item(i).value + '=' + qty);
    }
    
    var stringVal = ArrID.join();
    var xhr = new XMLHttpRequest();
    var token = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    xhr.open('POST', 'http://127.0.0.1:8000/api/updatecart');
    xhr.setRequestHeader ( "Content-type", "application/x-www-form-urlencoded" );
    xhr.responseType = 'json';
    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.response);
                window.location = '{{ url("/checkout") }}';
            }
        }
    };
    xhr.send("proqty=" + stringVal + "&token=" + token);

}

</script>
@include('frontend.layout.footer')