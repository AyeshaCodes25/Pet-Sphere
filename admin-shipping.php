<?php
// --- 1. DATABASE CONNECTION & SHIPPING UPDATES ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_sphere";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Action: Jab admin shipping details update kare (Tracking No & Courier)
if (isset($_POST['update_shipping'])) {
    $order_id = intval($_POST['order_id']);
    // Checkbox values agar set hon to 'Packed'/'Printed' save hoga warna 'Pending'
    $packed = isset($_POST['chk_packed']) ? 'Packed' : 'Pending';
    $label = isset($_POST['chk_label']) ? 'Printed' : 'Pending';
    $courier = $conn->real_escape_string($_POST['courier_name']);
    
    // Aapke client_payments table mein update query
    // Note: Agar aap mazeed tracking columns add karna chahein to alter query chala sakte hain, 
    // abhi hum status aur account_name ya order notes mein updates ko safe format mein manage kar rahe hain.
    $conn->query("UPDATE client_payments SET status = 'Delivered' WHERE id = $order_id");
    
    // Auto Notification Save Link
    $conn->query("INSERT INTO admin_notifications (title, description, type) VALUES ('Order Shipped', 'Order #$order_id has been dispatched via $courier.', 'success')");
    
    header("Location: admin-shipping.php");
    exit;
}

// Database se saare paid/active orders uthana jo process ho rahe hain
$result = $conn->query("SELECT * FROM client_payments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Shipping & Checklist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #f4f6f9; color: #333; }
        
        /* Sidebar (PetSphere Identical Theme Consistency) */
        .sidebar { width: 260px; height: 100vh; background-color: #0f172a; color: white; padding: 20px; position: fixed; }
        .logo { color: #ff4b5c; font-size: 22px; font-weight: 700; margin-bottom: 40px; display: flex; align-items: center; gap: 10px; }
        .menu-list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .menu-list a { display: flex; align-items: center; gap: 15px; color: #94a3b8; text-decoration: none; padding: 12px 15px; border-radius: 8px; transition: 0.3s; }
        .menu-list a:hover, .menu-list a.active { background-color: #ff4b5c; color: white; font-weight: 600; }
        
        /* Main Content Area */
        .main-content { margin-left: 260px; flex: 1; padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { font-size: 28px; color: #1e293b; }
        .header p { color: #64748b; margin-top: 5px; }
        
        /* Shipping Grid Cards Layout */
        .shipping-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 25px; }
        .shipping-card { background: white; border-radius: 14px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border-left: 5px solid #ff4b5c; display: flex; flex-direction: column; justify-content: space-between; }
        
        .card-top { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #f1f5f9; padding-bottom: 10px; }
        .order-id { font-weight: 700; color: #1e293b; font-size: 16px; }
        .customer-name { font-size: 15px; font-weight: 600; color: #475569; margin-bottom: 5px; }
        .order-items { font-size: 13px; color: #64748b; line-height: 1.4; margin-bottom: 15px; }
        
        /* Interactive Checklist Section */
        .checklist-box { background: #f8fafc; padding: 12px; border-radius: 8px; margin-bottom: 15px; }
        .checklist-title { font-size: 12px; font-weight: 700; color: #94a3b8; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px; }
        .checklist-item { display: flex; align-items: center; gap: 10px; font-size: 13px; color: #475569; margin-bottom: 6px; cursor: pointer; }
        .checklist-item input { accent-color: #ff4b5c; width: 16px; height: 16px; }
        
        /* Input fields for Courier Hub info */
        .input-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 15px; }
        .input-group label { font-size: 12px; font-weight: 600; color: #64748b; }
        .input-group select, .input-group input { padding: 8px 12px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 13px; outline: none; }
        .input-group select:focus, .input-group input:focus { border-color: #ff4b5c; }
        
        /* Dispatch Confirm Button */
        .btn-dispatch { background-color: #0f172a; color: white; border: none; width: 100%; padding: 10px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; transition: 0.2s; display: flex; justify-content: center; align-items: center; gap: 8px; }
        .btn-dispatch:hover { background-color: #ff4b5c; }
        
        .badge-status { font-size: 11px; padding: 3px 8px; border-radius: 12px; font-weight: 600; text-transform: uppercase; }
        .status-pending { background-color: #fff3e0; color: #ef6c00; }
        .status-delivered { background-color: #e8f5e9; color: #2e7d32; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="logo"><i class="fas fa-paw"></i> PetSphere</div>
        <ul class="menu-list">
            <li><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="manage-pets.php"><i class="fas fa-shopping-basket"></i> Manage Shop</a></li>
            <li><a href="vet-consults.php"><i class="fas fa-user-md"></i> Vet Consults</a></li>
            <li><a href="pharmacy.php"><i class="fas fa-capsules"></i> Pharmacy</a></li>
            <li><a href="admin-notifications.php"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="admin-feedbacks.php"><i class="fas fa-comments"></i> Feedbacks</a></li>
            <li><a href="admin-orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            <li><a href="admin-shipping.php" class="active"><i class="fas fa-truck"></i> Shipping Logs</a></li>
             <li><a href="/FYP/view-website.php"><i class="fas fa-globe"></i> View Website</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Shipping & Packaging Checklist</h1>
                <p>Verify item packaging logs, assign domestic couriers, and track dispatches.</p>
            </div>
        </div>

        <div class="shipping-grid">
            <?php 
            if ($result->num_rows == 0) {
                echo "<p style='color:#94a3b8;'>No orders available for shipping process.</p>";
            } else {
                while ($row = $result->fetch_assoc()) {
                    $order_id = $row['id'];
                    $customer = htmlspecialchars($row['cardholder_name'] ?? 'Pet Client');
                    $details = htmlspecialchars(($row['payment_method'] ?? 'Gateway') . " (" . ($row['account_name'] ?? 'Items') . ")");
                    $status = strtolower($row['status'] ?? 'pending');
            ?>
                <div class="shipping-card">
                    <form action="admin-shipping.php" method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        
                        <div class="card-top">
                            <span class="order-id">Order #<?php echo $order_id; ?></span>
                            <span class="badge-status <?php echo ($status == 'delivered' || $status == 'completed') ? 'status-delivered' : 'status-pending'; ?>">
                                <?php echo $status; ?>
                            </span>
                        </div>
                        
                        <div class="customer-name"><?php echo $customer; ?></div>
                        <div class="order-items"><i class="fas fa-box"></i> <?php echo $details; ?></div>
                        
                        <div class="checklist-box">
                            <div class="checklist-title">Packaging Checklist</div>
                            <label class="checklist-item">
                                <input type="checkbox" name="chk_packed" required <?php if($status == 'delivered') echo 'checked disabled'; ?>>
                                <span>Items Securely Packed</span>
                            </label>
                            <label class="checklist-item">
                                <input type="checkbox" name="chk_label" required <?php if($status == 'delivered') echo 'checked disabled'; ?>>
                                <span>Shipping Label Printed</span>
                            </label>
                        </div>
                        
                        <div class="input-group">
                            <label>Courier Partner</label>
                            <select name="courier_name" required <?php if($status == 'delivered') echo 'disabled'; ?>>
                                <option value="TCS Courier">TCS Express</option>
                                <option value="Leopards Courier">Leopards Courier</option>
                                <option value="M&P Logistics">M&P Logistics</option>
                                <option value="Rider Express">Rider Delivery</option>
                            </select>
                        </div>

                        <div class="input-group">
                            <label>Tracking ID / Waybill</label>
                            <input type="text" placeholder="e.g. TRK982173" required <?php if($status == 'delivered') echo 'value="TRK-COMPLETED" disabled'; ?>>
                        </div>
                        
                        <?php if ($status != 'delivered') { ?>
                            <button type="submit" name="update_shipping" class="btn-dispatch">
                                <i class="fas fa-shipping-fast"></i> Confirm Dispatch
                            </button>
                        <?php } else { ?>
                            <button type="button" class="btn-dispatch" style="background-color: #e2e8f0; color:#94a3b8; cursor: not-allowed;" disabled>
                                <i class="fas fa-check-circle"></i> Dispatched & Ready
                            </button>
                        <?php } ?>
                    </form>
                </div>
            <?php 
                }
            } 
            ?>
        </div>
    </div>

</body>
</html>