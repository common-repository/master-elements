// jQuery(function ($) {
//
// const numberOfItemsInCart =  document.querySelectorAll('.shop_table tbody .cart_item').length;
//
// let btn = document.createElement("button");
//
// btn.classList.add("cart-total");
//
//
// btn.innerHTML = '<i class = "fa fa-shopping-cart"></i>';
// btn.innerHTML += `<span class="cart-total-items"> ${numberOfItemsInCart} </span>`;
// btn.onclick = function () {
//     alert("Button is clicked");
// };
//
// document.querySelector('.entry-header h1').appendChild(btn);
// //jquery event handler
// jQuery(document.body).on('updated_wc_div', function () {
//     const numberOfItemsInCart =  document.querySelectorAll('.shop_table tbody .cart_item').length;
//     let btn = $('.cart-total');
//
//     btn.html(`<i class = "fa fa-shopping-cart"></i>`.concat(`<span class="cart-total-items">${numberOfItemsInCart}</span>`));
// });
//
// $('.shop_table tbody .cart_item').each(function(index,value){
//     console.log($(this).find('img').attr('src'));
//     console.log($(this).find('.product-name a').text());
//     console.log($(this).find('.product-price bdi').contents().eq(1).text());
// });
//
// $(document.body).on('adding_to_cart', function(){
//     alert('Yo');
// });
//
//
// });


//     $('.cart-button-with-logox').on('click', function(){
//        const cart_items = $('#card-datax').val();
//        alert(cart_items);
//     });
//






//     jQuery(document.body).on('added_to_cart removed_from_cart', function () {
//         console.log('awrf');
//     let numberOfItemsInCart =  document.querySelectorAll('#custom-cart-widget-div-id .custom-menu-cart').length+1;
//     console.log('qwerty',numberOfItemsInCart);
//     let btn = $('.cart-button-with-logox');
//         btn.html(`<i class = "cart_icon_select"></i>`.concat(`<span class="cart-total-items">${numberOfItemsInCart}</span>`));
//     // btn.html(numberOfItemsInCart);
//
//     });
//
//
// });

function myFunction() {

    let x = document.getElementById("custom-cart-widget-div-id");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }

}

































