// Back Button

const backBtn = document.querySelector(".back-btn");

backBtn.addEventListener("click", function () {

    alert("Back Button Clicked");

});


// Filter Buttons

const buttons = document.querySelectorAll(".filters button");

buttons.forEach(function(button){

    button.addEventListener("click", function(){

        alert(button.innerText);

    });

});


// Product Cards

const cards = document.querySelectorAll(".card");

cards.forEach(function(card){

    card.addEventListener("click", function(){

        alert("Product Opened");

    });

});