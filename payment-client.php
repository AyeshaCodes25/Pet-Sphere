<?php
// 1. Connection File Include Ki
include('config.php');

$success_msg = "";

// 2. BACKEND INSERT WORK
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_payment'])) {
    
    $method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $amount = 15500; // Fixed Amount as per your summary
    $status = "Completed"; // Card payment auto-complete, Mobile dynamic ho sakti h
    
    if ($method == 'Card') {
        $card_name = mysqli_real_escape_string($conn, $_POST['card_name']);
        // Security ke liye card number ke aakhri 4 digits save karna best practice h fyp me
        $card_num = mysqli_real_escape_string($conn, $_POST['card_number']);
        $expiry = mysqli_real_escape_string($conn, $_POST['expiry_date']);
        
        $insert_query = "INSERT INTO `client_payments` (`payment_method`, `cardholder_name`, `card_number`, `expiry_date`, `amount`, `status`, `created_at`) 
                         VALUES ('Card', '$card_name', '$card_num', '$expiry', '$amount', '$status', NOW())";
                         
    } else if ($method == 'Mobile') {
        $mobile_num = mysqli_real_escape_string($conn, $_POST['mobile_number']);
        $account_name = mysqli_real_escape_string($conn, $_POST['account_name']);
        $status = "Pending"; // Mobile prompt client ke confirmation tak pending rehta h
        
        $insert_query = "INSERT INTO `client_payments` (`payment_method`, `mobile_number`, `account_name`, `amount`, `status`, `created_at`) 
                         VALUES ('Mobile Wallet', '$mobile_num', '$account_name', '$amount', '$status', NOW())";
    }
    
    if (mysqli_query($conn, $insert_query)) {
        // Javascript Alert for success message
        echo "<script>
                alert('Payment Transaction Request Processed Successfully!');
                window.location.href='payment-client.php';
              </script>";
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Payments</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="payment-client.css">
</head>
<body>

    <div class="app-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">PetSphere</div>
            <nav class="menu-list">
                <a href="dashboard-client.php" class="menu-item"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="notification.php" class="menu-item"><i class="fas fa-bell"></i> Notifications</a>
                <a href="#" class="menu-item active"><i class="fas fa-credit-card"></i> Payments</a>
                <a href="history-client.php" class="menu-item"><i class="fas fa-history"></i> History</a>
                <a href="client-orders.php" class="menu-item"><i class="fas fa-shopping-bag"></i> My Orders</a>
                <a href="website-client.php" class="menu-item"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout-client.php" class="menu-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="main-panel">
            <header class="content-header">
                <div class="title-group">
                    <h1>Payment Methods</h1>
                    <p>Securely manage your billing and transactions</p>
                </div>
            </header>

            <div class="payment-grid">
                <div class="forms-wrapper">
                    
                    <div id="card-form" class="data-card payment-form active">
                        <h3>Pay via Card</h3>
                        <form action="payment-client.php" method="POST">
                            <input type="hidden" name="payment_method" value="Card">
                            <input type="hidden" name="submit_payment" value="1">
                            
                            <div class="field-group">
                                <label>Cardholder Name</label>
                                <input type="text" name="card_name" placeholder="Enter your name" class="form-input" required>
                            </div>
                            <div class="field-group">
                                <label>Card Number</label>
                                <input type="text" name="card_number" placeholder="xxxx xxxx xxxx xxxx" class="form-input" required>
                            </div>
                            <div class="form-row">
                                <div class="field-group">
                                    <label>Expiry Date</label>
                                    <input type="text" name="expiry_date" placeholder="MM/YY" class="form-input" required>
                                </div>
                                <div class="field-group">
                                    <label>CVV</label>
                                    <input type="password" placeholder="***" class="form-input" required>
                                </div>
                            </div>
                            <button type="submit" class="submit-red-btn">Pay Rs. 15,500 Now</button>
                        </form>
                    </div>

                    <div id="mobile-form" class="data-card payment-form">
                        <h3>Pay via EasyPaisa / JazzCash</h3>
                        <form action="payment-client.php" method="POST">
                            <input type="hidden" name="payment_method" value="Mobile">
                            <input type="hidden" name="submit_payment" value="1">
                            
                            <div class="field-group">
                                <label>Mobile Number</label>
                                <input type="text" name="mobile_number" placeholder="03xx xxxxxxx" class="form-input" required>
                            </div>
                            <div class="field-group">
                                <label>Account Holder Name</label>
                                <input type="text" name="account_name" placeholder="Full Name" class="form-input" required>
                            </div>
                            <p class="helper-text"><em>A prompt will be sent to your mobile to confirm the transaction.</em></p>
                            <button type="submit" class="submit-red-btn">Request Mobile Payment</button>
                        </form>
                    </div>
                </div>

                <div class="side-panel">
                    <div class="data-card">
                        <h3>Order Summary</h3>
                        <div class="summary-line"><span>Vet Consultation</span> <strong>Rs. 5,000</strong></div>
                        <div class="summary-line"><span>Medicine Order</span> <strong>Rs. 10,500</strong></div>
                        <hr>
                        <div class="summary-line total"><span>Total Amount</span> <strong>Rs. 15,500</strong></div>
                    </div>

                    <div class="data-card">
                        <h3>Other Methods</h3>
                        <div class="method-selector">
                            <label class="radio-card">
                                <input type="radio" name="pay_toggle" onclick="togglePay('card-form')" checked>
                                <span><i class="fas fa-credit-card"></i> Credit / Debit Card</span>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="pay_toggle" onclick="togglePay('mobile-form')">
                                <span><i class="fas fa-mobile-alt"></i> EasyPaisa / JazzCash</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function togglePay(id) {
            document.querySelectorAll('.payment-form').forEach(f => f.classList.remove('active'));
            document.getElementById(id).classList.add('active');
        }
    </script>
</body>
</html>