<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Store</title>
  <!-- Google Fonts for Aesthetic Typography -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- CSS LINK -->
  <link rel="stylesheet" href="style.css">
</head>
<style>
</style>
<body>

  <!-- Categories Section -->
  <div id="category-section" class="page-fade">
    <h2 class="title">Explore Categories</h2>
    <div id="category" class="container">
      
      <div class="card" onclick="showProducts('cats')">
        <div class="img-wrapper">
          <img src="C:\Users\Pakistan\Pictures\Saved Pictures\cats.webp" alt="Cats">
        </div>
        <h3>Cats</h3>
      </div>

      <div class="card" onclick="showProducts('parrots')">
        <div class="img-wrapper">
          <img src="C:\Users\Pakistan\Pictures\Saved Pictures\parrots.jpg" alt="Parrots">
        </div>
        <h3>Parrots</h3>
      </div>

      <div class="card" onclick="showProducts('pigeons')">
        <div class="img-wrapper">
          <img src="C:\Users\Pakistan\Pictures\Saved Pictures\p.images.jfif" alt="Pigeons">
        </div>
        <h3>Pigeons</h3>
      </div>

    </div>
  </div>

  <!-- Products Section -->
  <div id="products" class="page-fade">
    <div class="top-bar">
      <button onclick="goBack()" class="back-btn">⬅ Back to Categories</button>
      <h2 id="productTitle" class="title"></h2>
    </div>

    <div id="productList" class="container"></div>
  </div>

  <script>
    function showProducts(type) {
      const catSection = document.getElementById("category-section");
      const prodSection = document.getElementById("products");
      
      // Smooth Transition Effect
      catSection.style.display = "none";
      prodSection.style.display = "block";
      prodSection.classList.remove('active');
      void prodSection.offsetWidth; // Trigger reflow for animation
      prodSection.classList.add('active');

      let title = document.getElementById("productTitle");
      let list = document.getElementById("productList");

      list.innerHTML = "";

      if(type === "cats") {
        title.innerText = "Cats Collection";
        list.innerHTML = `
        <div class="product-card">
          <img src="C:\\Users\\Pakistan\\Pictures\\Saved Pictures\\persian.jpg">
          <h4>Persian Cat</h4>
          <p>Long hair, calm & indoor</p>
          <div class="card-footer">
            <span class="price">Rs. 15,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>

        <div class="product-card">
          <img src="https://placekitten.com/202/200">
          <h4>Siamese Cat</h4>
          <p>Active & smart</p>
          <div class="card-footer">
            <span class="price">Rs. 12,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>

        <div class="product-card">
          <img src="https://placekitten.com/203/200">
          <h4>British Shorthair</h4>
          <p>Calm & fluffy</p>
          <div class="card-footer">
            <span class="price">Rs. 18,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>

        <div class="product-card">
          <img src="https://placekitten.com/204/200">
          <h4>Maine Coon</h4>
          <p>Large & friendly</p>
          <div class="card-footer">
            <span class="price">Rs. 25,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>

        <div class="product-card">
          <img src="https://placekitten.com/205/200">
          <h4>Ragdoll Cat</h4>
          <p>Soft & loving</p>
          <div class="card-footer">
            <span class="price">Rs. 20,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>

        <div class="product-card">
          <img src="https://placekitten.com/206/200">
          <h4>Bengal Cat</h4>
          <p>Energetic</p>
          <div class="card-footer">
            <span class="price">Rs. 22,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>

        <div class="product-card">
          <img src="https://placekitten.com/207/200">
          <h4>Scottish Fold</h4>
          <p>Cute folded ears</p>
          <div class="card-footer">
            <span class="price">Rs. 19,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>

        <div class="product-card">
          <img src="https://placekitten.com/208/200">
          <h4>Russian Blue</h4>
          <p>Quiet & elegant</p>
          <div class="card-footer">
            <span class="price">Rs. 17,000</span>
            <button class="cart-btn">Add to Cart</button>
          </div>
        </div>
        `;
      }

      else if(type === "parrots") {
        title.innerText = "Parrots Collection";
        list.innerHTML = `
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?1"><h4>Macaw</h4><p>Colorful</p><div class="card-footer"><span class="price">Rs. 25,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?2"><h4>African Grey</h4><p>Very smart</p><div class="card-footer"><span class="price">Rs. 30,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?3"><h4>Budgie</h4><p>Small & cute</p><div class="card-footer"><span class="price">Rs. 2,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?4"><h4>Cockatiel</h4><p>Friendly</p><div class="card-footer"><span class="price">Rs. 5,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?5"><h4>Lovebird</h4><p>Pair bird</p><div class="card-footer"><span class="price">Rs. 4,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?6"><h4>Amazon Parrot</h4><p>Talkative</p><div class="card-footer"><span class="price">Rs. 20,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?7"><h4>Eclectus</h4><p>Bright colors</p><div class="card-footer"><span class="price">Rs. 22,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/parrot?8"><h4>Ringneck</h4><p>Common pet</p><div class="card-footer"><span class="price">Rs. 6,000</span><button class="cart-btn">Add to Cart</button></div></div>
        `;
      }

      else if(type === "pigeons") {
        title.innerText = "Pigeons Collection";
        list.innerHTML = `
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?1"><h4>White Pigeon</h4><p>Peace bird</p><div class="card-footer"><span class="price">Rs. 3,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?2"><h4>Fantail</h4><p>Fan tail</p><div class="card-footer"><span class="price">Rs. 5,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?3"><h4>Homing</h4><p>Returns home</p><div class="card-footer"><span class="price">Rs. 4,500</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?4"><h4>King Pigeon</h4><p>Big size</p><div class="card-footer"><span class="price">Rs. 6,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?5"><h4>Tumbler</h4><p>Flying tricks</p><div class="card-footer"><span class="price">Rs. 4,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?6"><h4>Jacobin</h4><p>Feather hood</p><div class="card-footer"><span class="price">Rs. 7,000</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?7"><h4>Lahore Pigeon</h4><p>Local breed</p><div class="card-footer"><span class="price">Rs. 3,500</span><button class="cart-btn">Add to Cart</button></div></div>
        <div class="product-card"><img src="https://loremflickr.com/200/200/pigeon?8"><h4>Tippler</h4><p>High flyer</p><div class="card-footer"><span class="price">Rs. 5,500</span><button class="cart-btn">Add to Cart</button></div></div>
        `;
      }
    }

    function goBack() {
      const catSection = document.getElementById("category-section");
      const prodSection = document.getElementById("products");

      prodSection.style.display = "none";
      catSection.style.display = "block";
      catSection.classList.remove('active');
      void catSection.offsetWidth; 
      catSection.classList.add('active');
    }

    // Initialize first animation load
    window.onload = function() {
      document.getElementById("category-section").classList.add('active');
    }
  </script>
</body>
</html>