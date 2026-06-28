<?php
session_start();

// Agar user ne 'BUY NOW' button dabaya hai, to data session mein store karo
if (isset($_POST['item_name'])) {
    $_SESSION['cart_item'] = array(
        'name' => $_POST['item_name'],
        'price' => $_POST['item_price'],
        'category' => 'Pet Collection' // Yahan category set hogi
    );
}

// Data fetch karo
$product_name = isset($_SESSION['cart_item']) ? $_SESSION['cart_item']['name'] : "Sumifun Hemorrhoids External Internal Piles Treatment";
$product_price = isset($_SESSION['cart_item']) ? (float)$_SESSION['cart_item']['price'] : 922.00;
$product_cat = isset($_SESSION['cart_item']) ? "Animal Products" : "Medicines";

$shipping_fee = 15.00; 
$grand_total = $product_price + $shipping_fee;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart & Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    
    <style>
        /* بنیادی اسٹائلنگ اور فونٹ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f9f9f9;
            color: #333;
        }

        /* ٹاپ ہیڈر جہاں ہوم بٹن ہے */
        .top-navbar {
            background-color: #ffffff;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        }

        .logo-area {
            font-weight: 700;
            font-size: 22px;
            color: #d93838; /* برانڈ کلر */
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ہوم پیج پر جانے کا پیارا سا بٹن */
        .home-back-btn {
            background-color: #fceded;
            color: #d93838;
            padding: 10px 20px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: 1px solid #f5c6c6;
        }

        .home-back-btn:hover {
            background-color: #d93838;
            color: #ffffff;
            transform: translateY(-2px);
        }

        /* مین کنٹینر لے آؤٹ */
        .main-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .page-intro {
            margin-bottom: 25px;
        }

        .page-intro h2 {
            font-size: 26px;
            color: #222;
            margin-bottom: 5px;
        }

        .page-intro p {
            color: #666;
            font-size: 14px;
        }

        /* ٹو-کالم گریڈ */
        .cart-checkout-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 30px;
            align-items: start;
        }

        @media (max-width: 992px) {
            .cart-checkout-grid {
                grid-template-columns: 1fr;
            }
        }

        /* کارڈز کنٹینر */
        .content-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            border: 1px solid #eee;
        }

        .card-header-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            color: #444;
            border-bottom: 1px solid #f5f5f5;
            padding-bottom: 12px;
        }

        .card-header-title i {
            color: #d93838;
        }

        /* سلیکٹڈ آئٹم لے آؤٹ */
        .cart-item-box {
            background: #fafafa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .item-details .category-tag {
            font-size: 11px;
            text-transform: uppercase;
            background: #eef7ed;
            color: #2e7d32;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 6px;
        }

        .item-details h4 {
            font-size: 16px;
            color: #222;
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .item-details .item-uid {
            font-size: 12px;
            color: #999;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        /* کوانٹیٹی پلس مائنس کنٹرول */
        .quantity-wrapper {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            overflow: hidden;
        }

        .qty-change-btn {
            background: #f5f5f5;
            border: none;
            width: 32px;
            height: 32px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .qty-change-btn:hover {
            background: #e0e0e0;
        }

        .qty-number-input {
            width: 40px;
            text-align: center;
            border: none;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .display-price {
            font-size: 16px;
            font-weight: 700;
            color: #222;
            min-width: 90px;
            text-align: right;
        }

        .delete-item-icon {
            background: none;
            border: none;
            color: #b71c1c;
            cursor: pointer;
            font-size: 16px;
            transition: color 0.2s;
        }

        .delete-item-icon:hover {
            color: #ff1744;
        }

        /* آرڈر سمری فلوٹ بورڈ */
        .pricing-summary {
            border-top: 1px dashed #ddd;
            padding-top: 15px;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
            color: #666;
        }

        .price-row.grand-total-row {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            font-size: 18px;
            font-weight: 700;
            color: #222;
        }

        .price-row.grand-total-row .final-amount {
            color: #d93838;
        }

        /* بلنگ فارم فیلڈز */
        .billing-form .input-block {
            margin-bottom: 18px;
        }

        .billing-form label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #555;
            margin-bottom: 6px;
        }

        .billing-form input, 
        .billing-form textarea, 
        .billing-form select {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            color: #333;
            outline: none;
            transition: border-color 0.2s;
        }

        .billing-form input:focus, 
        .billing-form textarea:focus, 
        .billing-form select:focus {
            border-color: #d93838;
        }

        .submit-order-btn {
            width: 100%;
            background-color: #d93838;
            color: #fff;
            border: none;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            border-radius: 8px;
            cursor: pointer;
            letter-spacing: 0.5px;
            transition: background 0.3s, transform 0.2s;
            margin-top: 10px;
        }

        .submit-order-btn:hover {
            background-color: #b82828;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="top-navbar">
    <div class="logo-area">
        <i class="fa-solid fa-paw"></i> PET SPHERE
    </div>
    <a href="firstpage.php#shop" class="home-back-btn">
        <i class="fa-solid fa-house"></i> Go Back to Shop
    </a>
</div>

<div class="main-container">
    <div class="page-intro">
        <h2>Shopping Cart & Checkout</h2>
        <p>Review your selected item and fill out shipping details to confirm order</p>
    </div>

    <div class="cart-checkout-grid">
        
        <div class="content-card">
            <div class="card-header-title">
                <i class="fa-solid fa-basket-shopping"></i> Selected Items
            </div>

            <div class="cart-item-box">
                <div class="item-details">
                    <span class="category-tag"><?php echo htmlspecialchars($product_cat); ?></span>
                    <h4><?php echo htmlspecialchars($product_name); ?></h4>
                    <span class="item-uid">ID: #MED-<?php echo rand(100, 999); ?></span>
                </div>
                
                <div class="item-actions">
                    <div class="quantity-wrapper">
                        <button type="button" class="qty-change-btn decrement-btn">-</button>
                        <input type="number" class="qty-number-input" value="1" min="1" readonly>
                        <button type="button" class="qty-change-btn increment-btn">+</button>
                    </div>
                    
                    <div class="display-price">Rs. <span class="raw-price"><?php echo number_format($product_price, 2, '.', ''); ?></span></div>
                    <button type="button" class="delete-item-icon"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>

            <div class="pricing-summary">
                <div class="price-row">
                    <span>Subtotal</span>
                    <span>Rs. <span id="board-subtotal"><?php echo number_format($product_price, 2, '.', ''); ?></span></span>
                </div>
                <div class="price-row">
                    <span>Shipping Fee</span>
                    <span>Rs. <?php echo number_format($shipping_fee, 2, '.', ''); ?></span>
                </div>
                <div class="price-row grand-total-row">
                    <span>Grand Total</span>
                    <span class="final-amount">Rs. <span id="board-total"><?php echo number_format($grand_total, 2, '.', ''); ?></span></span>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header-title">
                <i class="fa-solid fa-truck-fast"></i> Shipping & Billing Details
            </div>

            <form class="billing-form" action="client-payment-shipping.php" method="POST">
                <div class="input-block">
                    <label>Full Name</label>
                    <input type="text" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="input-block">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="username@example.com" required>
                </div>

                <div class="input-block">
                    <label>Phone Number</label>
                    <input type="text" name="phone" placeholder="e.g., +92 300 1234567" required>
                </div>

                <div class="input-block">
                    <label>Shipping Address</label>
                    <textarea name="address" rows="3" placeholder="Complete street address, apartment, city" required></textarea>
</div>
                <div class="input-block">
                    <label>Payment Method</label>
                    <select name="payment_method" id="payment-method-select" required>
    <option value="cod">Cash on Delivery (COD)</option>
    <option value="easypaisa">Easypaisa / JazzCash</option>
</select>
                </div>

                <button type="submit" class="submit-order-btn">CONFIRM ORDER</button>
            </form>
        </div>

    </div>
</div>

<script>
    const incBtn = document.querySelector('.increment-btn');
    const decBtn = document.querySelector('.decrement-btn');
    const qtyField = document.querySelector('.qty-number-input');
    const baseAmount = parseFloat(document.querySelector('.raw-price').innerText);
    const transportFee = <?php echo $shipping_fee; ?>;

    const subtotalText = document.getElementById('board-subtotal');
    const totalText = document.getElementById('board-total');

    function recalculateBill(quantity) {
        const calculatedSubtotal = baseAmount * quantity;
        const calculatedTotal = calculatedSubtotal + transportFee;
        
        subtotalText.innerText = calculatedSubtotal.toFixed(2);
        totalText.innerText = calculatedTotal.toFixed(2);
    }

    incBtn.addEventListener('click', () => {
        qtyField.value = parseInt(qtyField.value) + 1;
        recalculateBill(parseInt(qtyField.value));
    });

    decBtn.addEventListener('click', () => {
        if (parseInt(qtyField.value) > 1) {
            qtyField.value = parseInt(qtyField.value) - 1;
            recalculateBill(parseInt(qtyField.value));
        }
    });
    // Function ke andar total update hone par hidden field ko update karein
function recalculateBill(quantity) {
    const calculatedSubtotal = baseAmount * quantity;
    const calculatedTotal = calculatedSubtotal + transportFee;
    
    subtotalText.innerText = calculatedSubtotal.toFixed(2);
    totalText.innerText = calculatedTotal.toFixed(2);
    
    // Yeh line total price ko place-order.php tak le jayegi
    document.getElementById('final-price-field').value = calculatedTotal.toFixed(2);
}
    const paymentSelect = document.getElementById('payment-method-select');

    paymentSelect.addEventListener('change', function() {
        // Agar user ne 'easypaisa' select kiya
        if (this.value === 'easypaisa') {
            // To foran usay Payment Page par bhej do
            window.location.href = 'client-payment-shipping.php';
        }
    });
</script>

</body>
</html>