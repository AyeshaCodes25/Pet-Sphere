<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Confirmed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <style>
        body { 
            background-color: #f1f3f6; 
            font-family: 'Segoe UI', sans-serif; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
            margin: 0; 
        }
        .success-card { 
            background: #ffffff; 
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            text-align: center; 
            max-width: 400px; 
            width: 90%;
        }
        .icon-box { 
            font-size: 60px; 
            color: #2e7d32; 
            margin-bottom: 20px; 
        }
        h1 { color: #1a1c2e; margin-bottom: 10px; }
        p { color: #666; margin-bottom: 25px; }
        .back-btn { 
            background-color: #f63854; 
            color: #fff; 
            padding: 12px 30px; 
            border-radius: 25px; 
            text-decoration: none; 
            font-weight: 600; 
            transition: 0.3s;
        }
        .back-btn:hover { background-color: #d6304a; }
    </style>
</head>
<body>

<div class="success-card">
    <div class="icon-box"><i class="fa-solid fa-circle-check"></i></div>
    <h1>Order Placed!</h1>
    <p>Thank you for shopping with Pet Sphere. Your order has been confirmed successfully.</p>
    <a href="firstpage.php/shop" class="back-btn">Back to Shop</a>
</div>

</body>
</html>