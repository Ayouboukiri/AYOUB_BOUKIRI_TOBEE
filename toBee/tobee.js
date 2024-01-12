
var cart = document.querySelector(".cart");
function show_cart(){

    cart.classList.add("active");
   
}

// close cart
function close_cart(){
    cart.classList.remove("active");

}

// cart working

    ready();

// Making function
function ready(){
    // remove items from cart
    var removeCartButtons = document.getElementsByClassName('cart-remove');
   
    for(var i = 0 ;i <removeCartButtons.length;i++){
        var button = removeCartButtons[i]
        button.addEventListener('click' , removeCartItem)

    }
    // quantity changes
    var quantityInputs = document.getElementsByClassName('cart-quantity')
    for(var i = 0 ;i <quantityInputs.length;i++){
       var input = quantityInputs[i];
       input.addEventListener('change',quantityChanged)

    }
    // add to cart
    var addCart = document.getElementsByClassName('add-cart')
    for(var i  = 0 ;i < addCart.length; i++){
        var button = addCart[i];
        button.addEventListener('click',addCartClicked);
    }
    // buy 
    document.getElementsByClassName('btn-buy')[0].addEventListener('click',buyButtonClicked);
   
    
    function buyButtonClicked() {
        var cartItems = document.querySelectorAll('.cart-box');
    
        var products = [];
    
        cartItems.forEach(function (cartItem) {
            var title = cartItem.querySelector('.cart-product-title').textContent.trim();
            var price = cartItem.querySelector('.cart-price').textContent.trim();
            var quantity = cartItem.querySelector('.cart-quantity').value;
    
            products.push({
                title: title,
                price: price,
                quantity: quantity
            });
        });
    
        fetch('beewax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(products),
        })
        .then(function(response) {
            return response.text();
        })
        .then(function(data) {
            console.log(data);
            localStorage.removeItem('cart');
            updateCartUI([]);
            upDateTotal();
        })
        .catch(function(error) {
            console.error('Error:', error);
        });
        clearLocalStorageCart()
    }
    
    

    

function removeCartItem(event){
    var buttonClicked = event.target;
    buttonClicked.parentElement.remove();
    upDateTotal();
}
function quantityChanged(event){
    var input = event.target
    if(isNaN(input.value) || input.value <= 0){
        input.value = 1
    }
    upDateTotal()

}

function addCartClicked(event) {
    var button = event.target;
    var shopProducts = button.parentElement;
    var title = shopProducts.getElementsByClassName('product-title')[0].innerText;
    var price = shopProducts.getElementsByClassName('price')[0].innerText;
    var productImg = shopProducts.getElementsByClassName('product_img')[0].src; 
    addProductToCart(title, price, productImg);
    upDateTotal(); 
}

//     upDateTotal();
// 
}function addProductToCart(title, price, productImg) {
    var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

    for (var i = 0; i < cartItems.length; i++) {
        if (cartItems[i].title === title) {
            alert("You have added this item to the cart");
            return;
        }
    }

    var cartItem = {
        title: title,
        price: price,
        productImg: productImg,
        quantity: 1
    };

    cartItems.push(cartItem);

    localStorage.setItem('cart', JSON.stringify(cartItems));

    // Update the cart UI
    updateCartUI(cartItems);

    upDateTotal();
}

function updateCartUI(cartItems) {
    var cartContainer = document.getElementsByClassName('cart-content')[0];
    cartContainer.innerHTML = '';  
    cartItems.forEach(function (item) {
        var cartShopBox = document.createElement('div');
        cartShopBox.classList.add('cart-box');

        var cartBoxContent = `
            <img src="${item.productImg}" alt="" class="cart-img">
            <div class="detail-box">
                <div class="cart-product-title">${item.title}</div>
                <div class="cart-price">${item.price}</div>
                <input type="number" value="${item.quantity}" class="cart-quantity" min="0"> 
            </div>
            <i class='bx bx-x cart-remove'></i>`;
        cartShopBox.innerHTML = cartBoxContent;

        cartContainer.appendChild(cartShopBox);

        cartShopBox.getElementsByClassName('cart-remove')[0].addEventListener('click', function () {
            removeCartItem(item.title);
        });
        cartShopBox.getElementsByClassName('cart-quantity')[0].addEventListener('change', function () {
            quantityChanged(item.title, this.value);
        });
    });
}

function removeCartItem(title) {
    var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

     cartItems = cartItems.filter(function (item) {
        return item.title !== title;
    });

     localStorage.setItem('cart', JSON.stringify(cartItems));

    // Update the cart UI
    updateCartUI(cartItems);

    upDateTotal();
}

function quantityChanged(title, newQuantity) {
    var cartItems = JSON.parse(localStorage.getItem('cart')) || [];

     for (var i = 0; i < cartItems.length; i++) {
        if (cartItems[i].title === title) {
            cartItems[i].quantity = parseInt(newQuantity);
            break;
        }
    }

     localStorage.setItem('cart', JSON.stringify(cartItems));

    upDateTotal();
}
 


function upDateTotal() {
    var cartContent = document.getElementsByClassName('cart-content')[0];
    var cartBoxes = cartContent.getElementsByClassName('cart-box');
    var total = 0;

    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var priceElement = cartBox.getElementsByClassName('cart-price')[0];
        var quantityElement = cartBox.getElementsByClassName('cart-quantity')[0];
        
        var priceText = priceElement.innerText.trim().replace(/\D+/g, '');//replace(/\D+/g, '') replace char whit num
        var price = parseFloat(priceText);
        var quantity = quantityElement.value;
        total += price * quantity;
    }
    total = Math.round(total * 100) / 100;
    document.getElementsByClassName('total-price')[0].innerText = total + "DH";
    
}



// search

function close_popup() {
    var popup = document.querySelector(".popup_container");
    if (popup) {
        popup.remove();
    }
}

function contact_us() {
    var contact = document.querySelector(".contact_us_container");

    contact.classList.add("open");
}
function close_contact() {
    var contact = document.querySelector(".contact_us_container");
    if (contact) {
        contact.classList.remove("open");
    }
}
function delete_product() {
    var delep = document.getElementById("delete_popup");

    delep.classList.add("on");
}
function close_delete() {
    var delep = document.getElementById("delete_popup");
    if (delep) {
        delep.classList.remove("on");
    }
}



function clearLocalStorageCart() {
    localStorage.removeItem('cart');

     updateCartUI([]);
    upDateTotal();
    }
 function loadCartFromStorage() {
    var storedCartData = localStorage.getItem('cartData');
    if (storedCartData) {
        var cartData = JSON.parse(storedCartData);

        for (var i = 0; i < cartData.length; i++) {
            var item = cartData[i];
            addProductToCart(item.title, item.price, '');
            var cartContent = document.getElementsByClassName('cart-content')[0];
            var cartBoxes = cartContent.getElementsByClassName('cart-box');
            var cartBox = cartBoxes[cartBoxes.length - 1];
            cartBox.getElementsByClassName('cart-quantity')[0].value = item.quantity;
        }
    }
}

 function updateCartData() {
    var cartContent = document.getElementsByClassName('cart-content')[0];
    var cartBoxes = cartContent.getElementsByClassName('cart-box');
    var cartData = [];

    for (var i = 0; i < cartBoxes.length; i++) {
        var cartBox = cartBoxes[i];
        var title = cartBox.getElementsByClassName('cart-product-title')[0].innerText;
        var price = cartBox.getElementsByClassName('cart-price')[0].innerText;
        var quantity = cartBox.getElementsByClassName('cart-quantity')[0].value;

        cartData.push({
            title: title,
            price: price,
            quantity: quantity
        });
    }

     localStorage.setItem('cartData', JSON.stringify(cartData));
}

// Function to clear cart
function clearCart() {
    localStorage.removeItem('cart');
    updateCartUI([]); // Clear the cart UI
    upDateTotal(); // Update the total
}

function initCart() {
    var cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    updateCartUI(cartItems);
    upDateTotal();
}

 initCart();
// show password
function showPass(){
    if(document.getElementById('Password').type == 'text')
    {document.getElementById('Password').type = 'password';
    document.getElementById('show_password').innerHTML=`<i class='bx bx-hide' ></i>`;

    }
    else{document.getElementById('Password').type = 'text';
    document.getElementById('show_password').innerHTML=`<i class='bx bx-show-alt' ></i>`;

    }
   

}