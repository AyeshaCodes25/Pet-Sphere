<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pigeons Collection | Premium Pet Boutique</title>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="pigeon.css">
  <link rel="stylesheet" href="pigeons-style.css">
</head>
<style>
    /* ==========================================================================
   PIGEONS PAGE PREMIUM UTILITY STYLES
   ========================================================================== */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Fredoka:wght@700&display=swap');

body {
    background-image: url('images/background-pigeons.jpeg') !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-attachment: fixed !important;
}

.pigeons-page-title {
    font-family: 'Fredoka', 'Plus Jakarta Sans', sans-serif !important;
    font-size: 36pt !important;
    font-weight: 800 !important;
    color: blue !important;
    text-align: center !important;
    margin: 35px 0 20px 0 !important;
    letter-spacing: -0.5px !important;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.08) !important;
    display: block !important;
}

.product-card {
    background-color: #ffffff !important;
    border: 2px solid darkblue !important;
    border-radius: 20px !important;
    padding: 18px !important;
    display: flex !important;
    flex-direction: column !important;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04) !important;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.product-card:hover {
    transform: translateY(-6px) !important;
    box-shadow: 0 16px 35px rgba(30, 70, 32, 0.12) !important;
}

.products-container { max-width: 1200px; margin: 0 auto; padding: 20px 0; }
.navigation-bar { width: 100%; padding: 20px; display: block; text-align: left; background-color: transparent; margin-bottom: 30px; }

.back-btn {
    display: inline-block; padding: 10px 24px; background-color: #ffffff;
    color: darkblue; border: 1.5px solid #ffe3e8; border-radius: 50px;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 10.5pt; font-weight: 600;
    text-decoration: none !important; cursor: pointer;
}
.back-btn:hover { background-color: darkblue; color: #ffffff !important; border-color: darkblue; }

.products-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 30px; }
.product-img-wrapper { width:100%; height: 200px; border-radius: 15px; overflow: hidden; margin-bottom: 15px; }
.product-img-wrapper img { width: 100%; height: 315px; object-fit: cover; transition: transform 0.6s ease; }
.product-card:hover .product-img-wrapper img { transform: scale(1.05); }

.product-footer { display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 15px; border-top: 1px solid #faf8f5; }
.product-price { font-size: 1.15rem; font-weight: 700; color: #8a7355; }
.add-to-cart-btn { padding: 10px 18px; background-color: #2c2927; color: #ffffff; border: none; border-radius: 10px; cursor: pointer; }
</style>
<body>

  <div class="products-container">
    <div class="navigation-bar">
      <a href="firstpage.php#shop" class="back-btn"><span>&larr;</span> Back to Categories</a>
      <h2 class="pigeons-page-title">Pigeons Collection</h2>
    </div>

    <div class="products-grid">
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Teddy-pigeon.jpeg" alt="Teddy Pigeon"></div>
        <div class="product-info"><h4>Teddy Pigeon</h4><p>Pure white feathers, symbol of peace, and very gentle nature.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 8,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Teddy Pigeon">
            <input type="hidden" name="item_price" value="8000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Kamagar-pigeon.jpeg" alt="Kamagar Pigeon"></div>
        <div class="product-info"><h4>Kamagar Pigeon</h4><p>Stunning fan-shaped tail like a peacock, proud posture and elegant gait.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 5,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Kamagar Pigeon">
            <input type="hidden" name="item_price" value="5000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Fantail-pigeon.jpeg" alt="Fantail Pigeon"></div>
        <div class="product-info"><h4>Fantail Pigeon</h4><p>Exceptional navigation skills, loyal breed, known for finding its way home.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 4,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Fantail Pigeon">
            <input type="hidden" name="item_price" value="4000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Sialkoti-pigeon.jpeg" alt="Sialkoti Pigeon"></div>
        <div class="product-info"><h4>Sialkoti Pigeon</h4><p>Large exhibition breed, beautifully heavy body with a calm personality.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 4,500 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Sialkoti Pigeon">
            <input type="hidden" name="item_price" value="4500">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Jacobin-pigeon.jpeg" alt="Jacobin Pigeon"></div>
        <div class="product-info"><h4>Jacobin Pigeon</h4><p>Famous for performing acrobatic backward flips while flying high.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 14,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Jacobin Pigeon">
            <input type="hidden" name="item_price" value="14000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Pouter-pigeon.jpeg" alt="Pouter Pigeon"></div>
        <div class="product-info"><h4>Pouter Pigeon</h4><p>Distinguished by an incredible, dense muff of feathers forming a hood.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 17,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Pouter Pigeon">
            <input type="hidden" name="item_price" value="17000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Feral-pigeon.jpeg" alt="Feral Pigeon"></div>
        <div class="product-info"><h4>Feral Pigeon</h4><p>Beautiful local heritage breed with unique marked feather patterns.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 600 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Feral Pigeon">
            <input type="hidden" name="item_price" value="600">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Shirazi-pigeon.jpeg" alt="Shirazi Pigeon"></div>
        <div class="product-info"><h4>Shirazi Pigeon</h4><p>Endurance flyer, capable of staying in the air for hours continuously.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 6,500 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Shirazi Pigeon">
            <input type="hidden" name="item_price" value="6500">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</body>
</html>