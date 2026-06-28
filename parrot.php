<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Parrots Collection | Premium Pet Boutique</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Main Common Style Link -->
  <link rel="stylesheet" href="parrots.css">
  <!-- Separate Parrots Page Style Link -->
  <link rel="stylesheet" href="parrots-style.css">
</head>
<style>
    /* ==========================================================================
   PARROTS PAGE PREMIUM UTILITY STYLES
   ========================================================================== */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800&family=Fredoka:wght@700&display=swap');

body {
    background-image: url('images/background-parrot.jpeg') !important;
    background-size: cover !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
    background-attachment: fixed !important;
}

.parrots-page-title {
    font-family: 'Fredoka', 'Plus Jakarta Sans', sans-serif !important;
    font-size: 36pt !important;
    font-weight: 800 !important;
    color: #98ec8c !important;
    text-align: center !important;
    margin: 35px 0 20px 0 !important;
    letter-spacing: -0.5px !important;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.08) !important;
    display: block !important;
}

.product-card {
    background-color: #ffffff !important;
    border: 2px solid #1e4620 !important;
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
    color: green; border: 1.5px solid #ffe3e8; border-radius: 50px;
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 10.5pt; font-weight: 600;
    text-decoration: none !important; cursor: pointer;
}
.back-btn:hover { background-color: green; color: #ffffff !important; border-color: green; }

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
      <h2 class="parrots-page-title">Parrots Collection</h2>
    </div>

    <div class="products-grid">
      <!-- Green Ringneck -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/green-ringneck.jpeg" alt="Green Ringneck"></div>
        <div class="product-info"><h4>Green Ringneck</h4><p>Large, breathtakingly colorful, highly social and majestic bird.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 6,500 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Green Ringneck">
            <input type="hidden" name="item_price" value="6500">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <!-- Raw Parrot -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Raw-parrot.jpeg" alt="Raw Parrot"></div>
        <div class="product-info"><h4>Raw Parrot (Alexandrine)</h4><p>World-class talker, exceptionally smart, and emotionally intelligent.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 30,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Raw Parrot (Alexandrine)">
            <input type="hidden" name="item_price" value="30000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <!-- Love Birds -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Love-birds.jpeg" alt="Love Birds"></div>
        <div class="product-info"><h4>Love Birds</h4><p>Small, cheerful, budget-friendly and perfect for beginners.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 5,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Love Birds">
            <input type="hidden" name="item_price" value="5000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <!-- Cockatiel -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/Cockatiel.jpeg" alt="Cockatiel"></div>
        <div class="product-info"><h4>Cockatiel</h4><p>Gentle whistle-master, famous for distinct orange cheek patches.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 5,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Cockatiel">
            <input type="hidden" name="item_price" value="5000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <!-- Budgerigar -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/budgerigar.jpeg" alt="Budgerigar"></div>
        <div class="product-info"><h4>Budgerigar</h4><p>Small, vibrant, intensely loyal, and loves living in pairs.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 1,500 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Budgerigar">
            <input type="hidden" name="item_price" value="1500">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <!-- African Grey Parrot -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/African-grey.jpeg" alt="African Grey Parrot"></div>
        <div class="product-info"><h4>African Grey Parrot</h4><p>Extremely talkative, bold personality, and beautiful green feathers.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 100,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="African Grey Parrot">
            <input type="hidden" name="item_price" value="100000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <!-- Plum-headed Parakeet -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/plum-headed.jpeg" alt="Plum-headed Parakeet"></div>
        <div class="product-info"><h4>Plum-headed Parakeet</h4><p>Stunning dimorphic colors (bright green males, deep red females).</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 10,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Plum-headed Parakeet">
            <input type="hidden" name="item_price" value="10000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

      <!-- Sun Conure -->
      <div class="product-card">
        <div class="product-img-wrapper"><img src="images/sun-conure.jpeg" alt="Sun Conure"></div>
        <div class="product-info"><h4>Sun Conure</h4><p>Elegant long tail, clear speaking ability and iconic neck ring.</p></div>
        <div class="product-footer">
          <span class="product-price">Rs. 50,000 PKR</span>
          <form action="add-cart.php" method="POST" class="cart-form">
            <input type="hidden" name="item_name" value="Sun Conure">
            <input type="hidden" name="item_price" value="50000">
            <button type="submit" name="add_to_cart" class="add-to-cart-btn">BUY NOW</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</body>
</html>