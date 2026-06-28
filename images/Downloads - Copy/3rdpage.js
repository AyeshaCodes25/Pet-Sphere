// MENU ACTIVE

let menus = document.querySelectorAll(".menu");

menus.forEach(function(menu){

    menu.addEventListener("click", function(){

        menus.forEach(function(item){

            item.classList.remove("active");

        });

        menu.classList.add("active");

    });

});


// BUY BUTTON

let buyButton = document.querySelector(".buy-button");

buyButton.addEventListener("click", function(){

    alert("Buy Now Clicked");

});


// CART BUTTON

let cartButton = document.querySelector(".cart-button");

cartButton.addEventListener("click", function(){

    alert("Product Added To Cart");

});