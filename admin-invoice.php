<?php
// --- 1. DATABASE CONNECTION & FETCH ORDER DETAILS ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_sphere";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check karna ke order_id mili hai ya nahi
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    die("Invalid Order ID.");
}

$order_id = intval($_GET['order_id']);

// Order ka poora data nikalna aapke database columns ke mutabiq
$query = "SELECT * FROM client_payments WHERE id = $order_id";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    die("Order not found in the database.");
}

$order = $result->fetch_assoc();

// Variables bind karna aapke database structure ke mutabiq
$customer_name = htmlspecialchars($order['cardholder_name'] ?? 'Walking Customer');
$payment_method = htmlspecialchars($order['payment_method'] ?? 'Cash');
$account_details = htmlspecialchars($order['account_name'] ?? 'N/A');
$amount = htmlspecialchars($order['amount'] ?? '0.00');
$status = strtoupper($order['status'] ?? 'PENDING');
$date = htmlspecialchars($order['created_at'] ?? date("Y-m-d H:i:s"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Invoice #<?php echo $order_id; ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f5f5f5; padding: 30px; display: flex; justify-content: center; }
        
        /* Invoice Card Layout */
        .invoice-card { background: white; width: 100%; max-width: 800px; padding: 40px; border-radius: 12px; box-shadow: 0 4px 25px rgba(0,0,0,0.08); position: relative; }
        
        /* Ribbon top decoration */
        .invoice-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 8px; background-color: #ff4b5c; border-radius: 12px 12px 0 0; }
        
        /* Header section */
        .invoice-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f1f5f9; padding-bottom: 25px; margin-bottom: 30px; }
        .logo-area { color: #ff4b5c; font-size: 26px; font-weight: 700; display: flex; align-items: center; gap: 8px; }
        .invoice-title-box { text-align: right; }
        .invoice-title-box h2 { font-size: 24px; color: #0f172a; text-transform: uppercase; letter-spacing: 1px; }
        .invoice-title-box p { color: #64748b; font-size: 14px; margin-top: 4px; }
        
        /* Details Grid */
        .details-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 40px; margin-bottom: 40px; }
        .details-block h3 { font-size: 13px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 10px; }
        .details-block p { font-size: 15px; color: #334155; line-height: 1.6; }
        .details-block strong { color: #0f172a; font-weight: 600; }
        
        /* Modern Items Table */
        .invoice-table { width: 100%; border-collapse: collapse; text-align: left; margin-bottom: 30px; }
        .invoice-table th { background-color: #f8fafc; padding: 12px 15px; color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; }
        .invoice-table td { padding: 18px 15px; border-bottom: 1px solid #f1f5f9; color: #475569; font-size: 15px; }
        
        /* Summary Box Row */
        .summary-wrapper { display: flex; justify-content: flex-end; margin-top: 20px; }
        .summary-box { width: 100%; max-width: 300px; background-color: #f8fafc; padding: 20px; border-radius: 8px; }
        .summary-row { display: flex; justify-content: space-between; padding: 8px 0; font-size: 14px; color: #64748b; }
        .summary-row.total { border-top: 1px solid #e2e8f0; margin-top: 10px; padding-top: 12px; font-size: 18px; font-weight: 700; color: #ff4b5c; }
        
        /* Status Badges */
        .badge { padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 700; display: inline-block; }
        .badge-pending { background-color: #fff3e0; color: #ef6c00; }
        .badge-delivered { background-color: #e8f5e9; color: #2e7d32; }
        
        /* Floating Action Print Button (Screen Only) */
        .print-actions { text-align: center; margin-top: 25px; }
        .btn-action { background-color: #1e293b; color: white; border: none; padding: 12px 30px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: 0.2s; text-decoration: none; }
        .btn-action:hover { background-color: #ff4b5c; transform: translateY(-1px); }

        /* --- PRINT STYLES (Hide button & gray background during real print) --- */
        @media print {
            body { background: white; padding: 0; }
            .invoice-card { box-shadow: none; padding: 0; width: 100%; }
            .print-actions { display: none; }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div style="width: 100%; max-width: 800px;">
        <div class="invoice-card">
            
            <div class="invoice-header">
                <div class="logo-area">
                    <i class="fas fa-paw"></i> PetSphere
                </div>
                <div class="invoice-title-box">
                    <h2>INVOICE</h2>
                    <p>Order ID: <strong>#<?php echo $order_id; ?></strong></p>
                </div>
            </div>
            
            <div class="details-grid">
                <div class="details-block">
                    <h3>Billed To:</h3>
                    <p><strong>Name:</strong> <?php echo $customer_name; ?></p>
                    <p><strong>Account Info:</strong> <?php echo $account_details; ?></p>
                </div>
                <div class="details-block" style="text-align: right;">
                    <h3>Invoice Details:</h3>
                    <p><strong>Date:</strong> <?php echo $date; ?></p>
                    <p><strong>Gateway:</strong> <?php echo $payment_method; ?></p>
                    <p style="margin-top: 5px;">
                        <strong>Status:</strong> 
                        <span class="badge <?php echo ($status == 'DELIVERED' || $status == 'COMPLETED') ? 'badge-delivered' : 'badge-pending'; ?>">
                            <?php echo $status; ?>
                        </span>
                    </p>
                </div>
            </div>
            
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Transaction Description</th>
                        <th style="text-align: right;">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong><?php echo $account_details; ?></strong><br>
                            <small style="color: #94a3b8;">Processed via <?php echo $payment_method; ?></small>
                        </td>
                        <td style="text-align: right; font-weight: 600; color: #0f172a;">Rs. <?php echo $amount; ?></td>
                    </tr>
                </tbody>
            </table>
            
            <div class="summary-wrapper">
                <div class="summary-box">
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>Rs. <?php echo $amount; ?></span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (0%)</span>
                        <span>Rs. 0.00</span>
                    </div>
                    <div class="summary-row total">
                        <span>Grand Total</span>
                        <span>Rs. <?php echo $amount; ?></span>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="print-actions">
            <button onclick="window.print();" class="btn-action">
                <i class="fas fa-print"></i> Print Invoice
            </button>
            <a href="admin-orders.php" class="btn-action" style="background-color: #64748b;">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>

</body>
</html>