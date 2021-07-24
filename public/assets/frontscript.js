

//  Add to cart
var Cart = document.getElementById('lblCartCount');
var Count = Number(Cart.innerHTML);

var addToCart = (id,qty)=>{

    if(!qty){
        qty = 1;
    }

    var xhr = new XMLHttpRequest();
    var token = document.querySelector("meta[name='csrf-token']").getAttribute('content');
    xhr.open('POST', 'http://127.0.0.1:8000/api/addcart');
    xhr.setRequestHeader ( "Content-type", "application/x-www-form-urlencoded" );
    xhr.responseType = 'json';
    xhr.onload = function () {
        if (xhr.readyState === xhr.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.response);
                //console.log(xhr.responseText);
                Cart.innerHTML = xhr.response.cart;
            }
        }
    };
    xhr.send("productid=" + id + "&token=" + token + "&qty=" + qty);
}

window.onload = (event) => {
    console.log('page is fully loaded');
};

var addSubscribe = ()=>{
    var Email = document.getElementById('email').value;
    if(Email==''){
        alert('Please enter email');
    }else{
        let regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(Email.match(regexEmail)) {
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'http://127.0.0.1:8000/api/subscribe');
            xhr.setRequestHeader ( "Content-type", "application/x-www-form-urlencoded" );
            xhr.responseType = 'json';
            xhr.onload = function () {
                if (xhr.readyState === xhr.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.response);
                        alert(xhr.response.result);
                        document.getElementById('email').value = '';
                    }
                }
            };
            xhr.send("email=" + Email);

        } else {
            alert('Please enter valid email format'); 
        }
    }
}
