<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Animal Medicines</title>

  <link rel="stylesheet" href="1stpage.css"/>

  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
  />
</head>
<style>
    *{ margin:0; padding:0; box-sizing:border-box; }
    body{ font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: url('images/background-medicine.jpeg') no-repeat center center fixed; background-size: cover; color: #333; }
    .header{ display:flex; align-items:center; padding:20px 40px; gap:20px; background:white; box-shadow: 0 2px 10px rgba(0,0,0,0.03); }
    .back-btn{ font-size:24px; cursor:pointer; transition: color 0.2s; }
    .back-btn:hover { color: #ff6600; }
    .search-box{ flex:1; max-width: 600px; margin: 0 auto; height:45px; border:2px solid #ff6600; border-radius:25px; display:flex; align-items:center; justify-content:space-between; padding:0 20px; background:white; }
    .search-box input{ border:none; outline:none; width:100%; font-size:16px; }
    .search-icon{ font-size:18px; color:#ff6600; cursor: pointer; }
    .products{ display:grid; grid-template-columns: repeat(4, 1fr); gap:20px; padding: 30px 40px; max-width: 1400px; margin: 0 auto; }
    .card{ background:white; border-radius:12px; overflow:hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); transition: transform 0.2s, box-shadow 0.2s; cursor: pointer; border: 1px solid #eaeaea; display: flex; flex-direction: column; }
    .card:hover { transform: translateY(-5px); box-shadow: 0 6px 18px rgba(0,0,0,0.1); }
    .card img{ width: 100%; height: 180px; object-fit: contain; background: #ffffff; mix-blend-mode: multiply; display: block; margin: 0 auto; padding: 10px; box-shadow: inset 0 0 10px rgba(255,255,255,1); }
    .card-content{ padding:15px; display: flex; flex-direction: column; flex-grow: 1; justify-content: space-between; background: white; }
    .card-content h3{ font-size:14px; line-height:20px; color:#2c3e50; font-weight: 600; margin-bottom:15px; height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; text-align: center; }
    .card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: auto; }
    .price{ color:#ff6600; font-size:16px; font-weight:700; }
    .buy-now-btn { background: #2c3e50; color: white; border: none; padding: 8px 14px; font-size: 12px; font-weight: 600; border-radius: 6px; cursor: pointer; transition: background 0.2s, transform 0.2s; letter-spacing: 0.5px; }
    .buy-now-btn:hover { background: #ff6600; transform: scale(1.05); }
    @media(max-width:1024px){ .products{ grid-template-columns: repeat(3, 1fr); padding: 20px; } }
    @media(max-width:768px){ .header{ padding: 15px 20px; } .products{ grid-template-columns: repeat(2, 1fr); gap: 12px; padding: 12px; } .card img{ height:150px; padding: 5px; } .card-content{ padding: 10px; } .card-content h3{ font-size: 13px; line-height: 18px; height: 36px; margin-bottom: 10px; } .price{ font-size: 13px; } .buy-now-btn { padding: 6px 10px; font-size: 11px; } }
</style>
<body>

  <div class="header">
    <a href="firstpage.php#Medicines" class="back-btn" style="color: inherit; text-decoration: none;">
      <i class="fa-solid fa-angle-left"></i>
    </a>
    <div class="search-box">
      <input type="text" placeholder="Animal medicines">
      <div class="search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
    </div>
  </div>

  <div class="products">
    <!-- Updated Cards -->
    <div class="card" data-name="Drontal Cat Deworming Tablet" data-price="Rs. 450" data-image="images/drontel-medicine.jpeg">
      <img src="images/drontel-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Drontal Cat Deworming Tablet</h3>
        <div class="card-footer"><div class="price">Rs. 450</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Viusid Syrup For Pets" data-price="Rs. 1,850" data-image="images/viusid-medicine.jpeg">
      <img src="images/viusid-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Viusid Syrup For Pets</h3>
        <div class="card-footer"><div class="price">Rs. 1,850</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Carminal Pets Syrup" data-price="Rs. 1,150" data-image="images/carminal-medicine.jpeg">
      <img src="images/carminal-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Carminal Pets Syrup</h3>
        <div class="card-footer"><div class="price">Rs. 1,150</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Renalof Syrup" data-price="Rs. 1,500" data-image="images/renalof-medicine.jpeg">
      <img src="images/renalof-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Renalof Syrup</h3>
        <div class="card-footer"><div class="price">Rs. 1,500</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Praferan Anthelminth Tablet" data-price="Rs. 350" data-image="images/praferan-medicine.jpeg">
      <img src="images/praferan-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Praferan Anthelminth Tablet</h3>
        <div class="card-footer"><div class="price">Rs. 350</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Multi Vitamin Paste Cat" data-price="Rs. 1,350" data-image="images/multivitamin-medicine.jpeg">
      <img src="images/multivitamin-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Multi Vitamin Paste Cat</h3>
        <div class="card-footer"><div class="price">Rs. 1,350</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Frontline Spray for Cats" data-price="Rs. 3,200" data-image="images/metrozine-medicine.jpeg">
      <img src="images/metrozine-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Frontline Spray for Cats</h3>
        <div class="card-footer"><div class="price">Rs. 3,200</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Avian Calcium Syrup" data-price="Rs. 650" data-image="images/frontline-medicine.jpeg">
      <img src="images/frontline-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Avian Calcium Syrup</h3>
        <div class="card-footer"><div class="price">Rs. 650</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Avizyme Bird Vitamins" data-price="Rs. 950" data-image="images/avian-medicine.jpeg">
      <img src="images/avian-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Avizyme Bird Vitamins</h3>
        <div class="card-footer"><div class="price">Rs. 950</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Bird Electrolytes Powder" data-price="Rs. 600" data-image="images/avizyme-medicine.jpeg">
      <img src="images/avizyme-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Bird Electrolytes Powder</h3>
        <div class="card-footer"><div class="price">Rs. 600</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Doxycycline Bird Medicine" data-price="Rs. 400" data-image="images/electrolytes-medicine.jpeg">
      <img src="images/electrolytes-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Doxycycline Bird Medicine</h3>
        <div class="card-footer"><div class="price">Rs. 400</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Ivermectin Bird Drops" data-price="Rs. 550" data-image="images/doxycycline-medicine.jpeg">
      <img src="images/doxycycline-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Ivermectin Bird Drops</h3>
        <div class="card-footer"><div class="price">Rs. 550</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Nekton-S Vitamins" data-price="Rs. 3,500" data-image="images/ivermectin-medicine.jpeg">
      <img src="images/ivermectin-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Nekton-S Vitamins</h3>
        <div class="card-footer"><div class="price">Rs. 3,500</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Canker Treatment for Pigeons" data-price="Rs. 750" data-image="images/nekton-medicine.jpeg">
      <img src="images/nekton-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Canker Treatment for Pigeons</h3>
        <div class="card-footer"><div class="price">Rs. 750</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Amprolium Powder for Pigeons" data-price="Rs. 450" data-image="images/canker-medicine.jpeg">
      <img src="images/canker-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Amprolium Powder for Pigeons</h3>
        <div class="card-footer"><div class="price">Rs. 450</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Pigeon Multivitamin Toni" data-price="Rs. 700" data-image="images/amprolium-medicine.jpeg">
      <img src="images/amprolium-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Pigeon Multivitamin Toni</h3>
        <div class="card-footer"><div class="price">Rs. 700</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Metacam oral suspension" data-price="Rs. 5,500" data-image="images/pigeon-medicine.jpeg">
      <img src="images/pigeon-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Metacam oral suspension</h3>
        <div class="card-footer"><div class="price">Rs. 5,500</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Clavamox" data-price="Rs. 5,800" data-image="images/metacam-medicine.jpeg">
      <img src="images/metacam-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Clavamox</h3>
        <div class="card-footer"><div class="price">Rs. 5,800</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Rimadyl" data-price="Rs. 8,500" data-image="images/amoxicillin-medicine.jpeg">
      <img src="images/amoxicillin-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Rimadyl</h3>
        <div class="card-footer"><div class="price">Rs. 8,500</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Heat guard" data-price="Rs. 1,400" data-image="images/carprofen-medicine.jpeg">
      <img src="images/carprofen-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Heat guard</h3>
        <div class="card-footer"><div class="price">Rs. 1,400</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Apoquel" data-price="Rs. 14,500" data-image="images/heartguard-medicine.jpeg">
      <img src="images/heartguard-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Apoquel</h3>
        <div class="card-footer"><div class="price">Rs. 14,500</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Vetsource" data-price="Rs. 4,500" data-image="images/apoquel-medicine.jpeg">
      <img src="images/apoquel-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Vetsource</h3>
        <div class="card-footer"><div class="price">Rs. 4,500</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Baytril" data-price="Rs. 4,800" data-image="images/gabapentin-medicine.jpeg">
      <img src="images/gabapentin-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Baytril</h3>
        <div class="card-footer"><div class="price">Rs. 4,800</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>

    <div class="card" data-name="Enrofloxacin" data-price="Rs. 550" data-image="images/gabapentin-medicine.jpeg">
      <img src="images/enrofloxacin-medicine.jpeg" alt="">
      <div class="card-content">
        <h3>Enrofloxacin</h3>
        <div class="card-footer"><div class="price">Rs. 550</div><button class="buy-now-btn">BUY NOW</button></div>
      </div>
    </div>
  </div>

  <script>
  const backBtn = document.querySelector(".back-btn");
  if(backBtn) {
      backBtn.addEventListener("click", function () {
          window.location.href = "firstpage.php#Medicines";
      });
  }

  const cards = document.querySelectorAll(".card");
  cards.forEach(function(card){
      card.addEventListener("click", function(){
          const name = this.getAttribute("data-name");
          const price = this.getAttribute("data-price");
          const image = this.getAttribute("data-image");

          const formData = new FormData();
          formData.append("product_name", name);
          formData.append("product_price", price);
          formData.append("product_image", image);

          fetch("process-cart.php", {
              method: "POST",
              body: formData
          })
          .then(response => response.text())
          .then(data => {
              window.location.href = "add-cart.php";
          })
          .catch(error => console.error("Error:", error));
      });
  });
  </script>
</body>
</html>