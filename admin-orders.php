<?php
// --- 1. DATABASE CONNECTION & STATUS UPDATES ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_sphere";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Action: Jab admin order ka status change kare (e.g. Pending se Delivered)
if (isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = $_POST['status'];
    
    $conn->query("UPDATE client_payments SET status = '$new_status' WHERE id = $order_id");
    
    // Auto Notification Link: Admin activity panel mein automatic alert save hoga
    $conn->query("INSERT INTO admin_notifications (title, description, type) VALUES ('Order Updated', 'Order #$order_id status has been changed to $new_status.', 'info')");
    
    header("Location: admin-orders.php");
    exit;
}

// Action: Order cancel/delete karne ke liye
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM client_payments WHERE id = $delete_id");
    header("Location: admin-orders.php");
    exit;
}

// Database se saare orders fetch karna (Naye orders pehle dikhenge)
$result = $conn->query("SELECT * FROM client_payments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Manage Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #f4f6f9; color: #333; }
        
        /* Sidebar (PetSphere Identical Theme) */
        .sidebar { width: 260px; height: 100vh; background-color: #0f172a; color: white; padding: 20px; position: fixed; }
        .logo { color: #ff4b5c; font-size: 22px; font-weight: 700; margin-bottom: 40px; display: flex; align-items: center; gap: 10px; }
        .menu-list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .menu-list a { display: flex; align-items: center; gap: 15px; color: #94a3b8; text-decoration: none; padding: 12px 15px; border-radius: 8px; transition: 0.3s; }
        .menu-list a:hover, .menu-list a.active { background-color: #ff4b5c; color: white; font-weight: 600; }
        
        /* Main Content Layout */
        .main-content { margin-left: 260px; flex: 1; padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { font-size: 28px; color: #1e293b; }
        .header p { color: #64748b; margin-top: 5px; }
        
        /* Table Box Sheet Container */
        .table-container { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .orders-table { width: 100%; border-collapse: collapse; text-align: left; }
        .orders-table th { padding: 15px; color: #64748b; font-size: 14px; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
        .orders-table td { padding: 15px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        
        /* Interactive Status Dropdown */
        .status-select { padding: 6px 10px; border-radius: 6px; font-size: 13px; font-weight: 600; border: 1px solid #e2e8f0; background-color: #f8fafc; cursor: pointer; outline: none; transition: 0.2s; }
        .status-select:focus { border-color: #ff4b5c; }
        
        /* Dynamic Badges for Status Display */
        .status-badge { padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; text-transform: capitalize; }
        .badge-pending { background-color: #fff3e0; color: #ef6c00; }
        .badge-delivered { background-color: #e8f5e9; color: #2e7d32; }
        .badge-cancelled { background-color: #ffebee; color: #c62828; }
        
        /* Action Buttons */
        .btn-save { background-color: #1e293b; color: white; border: none; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-save:hover { background-color: #ff4b5c; }
        .btn-delete { background-color: #ffebee; color: #c62828; padding: 8px; border-radius: 6px; border: none; cursor: pointer; display: inline-flex; transition: 0.3s; }
        .btn-delete:hover { background-color: #ffdde2; }
        .btn-print { background-color: #e0f2fe; color: #0369a1; padding: 8px; border-radius: 6px; display: inline-flex; transition: 0.3s; text-decoration: none; }
        .btn-print:hover { background-color: #bae6fd; }
        
        .empty-state { text-align: center; padding: 40px; color: #94a3b8; font-size: 16px; }
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
            <li><a href="admin-orders.php" class="active"><i class="fas fa-shopping-cart"></i> Orders</a></li>
             <li><a href="/FYP/admin-shipping.php"><i class="fas fa-truck"></i> Shipping Logs</a></li>
            <li><a href="/FYP/view-website.php"><i class="fas fa-globe"></i> View Website</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Order Management</h1>
                <p>Track client purchases, manage delivery process, and update status logs.</p>
            </div>
        </div>

        <div class="table-container">
            <?php if ($result->num_rows == 0) { ?>
                <div class="empty-state">
                    <i class="fas fa-box-open" style="font-size: 40px; margin-bottom: 15px; display:block;"></i>
                    No customer orders received yet.
                </div>
            <?php } else { ?>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>ORDER ID</th>
                            <th>CUSTOMER</th>
                            <th>ITEMS / DETAILS</th>
                            <th>TOTAL PRICE</th>
                            <th>CURRENT STATUS</th>
                            <th>UPDATE STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = $result->fetch_assoc()) { 
                            // --- AUTO INTEGRATION: Aapke Real Database Columns Lag Gye Hain ---
                            $username = htmlspecialchars($row['cardholder_name'] ?? 'Client');
                            $items = htmlspecialchars(($row['payment_method'] ?? 'Method') . " - " . ($row['account_name'] ?? 'Details'));
                            $price = htmlspecialchars($row['amount'] ?? '0.00');
                            $status = strtolower($row['status'] ?? 'pending');
                            
                            // Badge color allocation
                            $badge_class = 'badge-pending';
                            if ($status == 'delivered' || $status == 'completed') $badge_class = 'badge-delivered';
                            if ($status == 'cancelled' || $status == 'rejected') $badge_class = 'badge-cancelled';
                        ?>
                            <tr>
                                <td style="font-weight: 700; color: #1e293b;">#<?php echo $row['id']; ?></td>
                                
                                <td style="font-weight: 600; color: #475569;"><?php echo $username; ?></td>
                                
                                <td style="color: #475569; max-width: 250px;"><?php echo $items; ?></td>
                                
                                <td style="font-weight: 700; color: #ff4b5c;">Rs. <?php echo $price; ?></td>
                                
                                <td>
                                    <span class="status-badge <?php echo $badge_class; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                
                                <td>
                                    <form action="admin-orders.php" method="POST" style="display: flex; gap: 8px; align-items: center;">
                                        <input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">
                                        <select name="status" class="status-select">
                                            <option value="Pending" <?php if($status == 'pending') echo 'selected'; ?>>Pending</option>
                                            <option value="Delivered" <?php if($status == 'delivered' || $status == 'completed') echo 'selected'; ?>>Delivered</option>
                                            <option value="Cancelled" <?php if($status == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                        </select>
                                        <button type="submit" name="update_status" class="btn-save">Save</button>
                                    </form>
                                </td>
                                
                                <td>
                                    <div style="display: flex; gap: 6px;">
                                        <a href="admin-invoice.php?order_id=<?php echo $row['id']; ?>" class="btn-print" target="_blank" title="Print Invoice">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        
                                        <a href="admin-orders.php?delete_id=<?php echo $row['id']; ?>" 
                                           class="btn-delete" 
                                           onclick="return confirm('Are you sure you want to remove this order log?');" title="Delete Log">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>

</body>
</html>