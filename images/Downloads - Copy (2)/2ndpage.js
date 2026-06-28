// MENU ACTIVE

const menus = document.querySelectorAll(".menu");

menus.forEach((menu) => {

    menu.addEventListener("click", () => {

        menus.forEach((item) => {
            item.classList.remove("active-menu");
        });

        menu.classList.add("active-menu");

    });

});


// BUY BUTTON

const buyButton = document.querySelector(".buy-btn");

buyButton.addEventListener("click", () => {

    alert("Buy Now Clicked");

});


// CART BUTTON

const cartButton = document.querySelector(".cart-btn");

cartButton.addEventListener("click", () => {

    alert("Product Added To Cart");

});


// HEART ICON

const heartIcon = document.querySelector(".fa-heart");

heartIcon.addEventListener("click", () => {

    heartIcon.classList.toggle("fa-solid");

});