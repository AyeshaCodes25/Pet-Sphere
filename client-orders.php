<?php
// --- 1. DATABASE CONNECTION ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_sphere";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Client ke saare orders fetch karna (Naye orders top par dikhenge)
$result = $conn->query("SELECT * FROM client_payments ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | My Purchase Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Sidebar layout integration wrapper */
        body { background-color: #f4f6f9; color: #333; display: flex; min-height: 100vh; }
        
        /* --- EXACT BACKDROP SIDEBAR CLONE FROM THE IMAGE --- */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #0f141d 0%, #1a2332 100%);
            color: #94a3b8;
            padding-top: 30px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .brand-section {
            padding: 0 25px 35px 25px;
            font-size: 24px;
            font-weight: 700;
            color: #ef4444; /* Soft Crimson Red Accent */
            display: flex;
            align-items: center;
            gap: 10px;
            letter-spacing: 0.5px;
        }

        .menu-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 0 10px;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 15px;
            font-weight: 500;
            border-radius: 0 25px 25px 0;
            transition: all 0.3s ease;
        }

        .menu-item a i {
            font-size: 16px;
            width: 20px;
        }

        /* Rounded Capsule Selection Tracker (Active Link Highlight) */
        .menu-item.active a {
            background-color: #ef4444;
            color: #ffffff;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .menu-item a:hover:not(.active a) {
            background-color: rgba(255, 255, 255, 0.05);
            color: #ffffff;
            padding-left: 25px;
        }
        
        /* --- RIGHT SIDE CORE PANEL WRAPPER --- */
        .main-content {
            margin-left: 260px; /* Sidebar layout separation gap offset */
            flex: 1;
            padding: 40px;
            background-color: #f8fafc;
        }
        
        /* Central Layout Container retaining your exact properties */
        .client-container { width: 100%; max-width: 1000px; background: white; padding: 30px; border-radius: 20px; box-shadow: 0 4px 25px rgba(0,0,0,0.05); margin-top: 20px; }
        
        /* Top Navigation Bar with your Cute Home Button layout styles preserved */
        .top-navbar { width: 100%; max-width: 1000px; display: flex; justify-content: flex-end; align-items: center; padding: 10px 0; }
        
        /* Cute Top Centered Home Button Preference retained */
        .btn-home { background-color: #ffebee; color: #ff4b5c; text-decoration: none; padding: 10px 20px; border-radius: 30px; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; box-shadow: 0 4px 10px rgba(255, 75, 92, 0.1); }
        .btn-home:hover { background-color: #ff4b5c; color: white; transform: translateY(-2px); }
        
        /* Header Title Area */
        .page-header { margin-bottom: 30px; border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; }
        .page-header h1 { font-size: 26px; color: #0f172a; }
        .page-header p { color: #64748b; font-size: 14px; margin-top: 4px; }
        
        /* Responsive Table Design retained completely */
        .orders-table { width: 100%; border-collapse: collapse; text-align: left; }
        .orders-table th { padding: 15px; color: #64748b; font-size: 13px; font-weight: 600; text-transform: uppercase; border-bottom: 2px solid #e2e8f0; background-color: #f8fafc; }
        .orders-table td { padding: 18px 15px; border-bottom: 1px solid #f1f5f9; color: #475569; font-size: 15px; vertical-align: middle; }
        
        /* Status Badges for Client View */
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; text-transform: capitalize; }
        .badge-pending { background-color: #fff3e0; color: #ef6c00; }
        .badge-delivered { background-color: #e8f5e9; color: #2e7d32; }
        .badge-cancelled { background-color: #ffebee; color: #c62828; }
        
        /* View/Invoice Download Receipt Button */
        .btn-receipt { background-color: #f1f5f9; color: #475569; padding: 8px 14px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; transition: 0.2s; }
        .btn-receipt:hover { background-color: #0f172a; color: white; }
        
        .empty-state { text-align: center; padding: 5px 0; color: #94a3b8; font-size: 16px; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand-section">
            <i class="fas fa-paw"></i> PetSphere
        </div>
        <ul class="menu-list">
            <li class="menu-item"><a href="dashboard-client.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li class="menu-item"><a href="notification.php"><i class="fas fa-bell"></i> Notifications</a></li>
            <li class="menu-item"><a href="payment-client.php"><i class="fas fa-credit-card"></i> Payments</a></li>
            <li class="menu-item"><a href="history-client.php"><i class="fas fa-history"></i> History</a></li>
            <li class="menu-item active"><a href="client-orders.php"><i class="fas fa-shopping-bag"></i> My Orders</a></li>
            <li class="menu-item"><a href="website-client.php"><i class="fas fa-globe"></i> View Website</a></li>
            <li class="menu-item" style="margin-top: auto; padding-bottom: 25px;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        
        <div class="top-navbar">
            <a href="dashboard-client.php" class="btn-home">
                <i class="fas fa-home"></i> Back to Dashboard
            </a>
        </div>

        <div class="client-container">
            <div class="page-header">
                <h1>My Purchase History</h1>
                <p>View your past orders, active payment statuses, and track your pet items delivery logs.</p>
            </div>

            <?php if ($result->num_rows == 0) { ?>
                <div class="empty-state" style="padding: 40px;">
                    <i class="fas fa-shopping-bag" style="font-size: 45px; color: #cbd5e1; margin-bottom: 15px; display: block;"></i>
                    You haven't placed any orders yet. Explore our shop or pharmacy to get started!
                </div>
            <?php } else { ?>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Billing Name</th>
                            <th>Items / Description</th>
                            <th>Total Paid</th>
                            <th>Delivery Status</th>
                            <th style="text-align: center;">Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = $result->fetch_assoc()) { 
                            // Columns exact database se fetch ho rahy hain
                            $order_id = $row['id'];
                            $billing_name = htmlspecialchars($row['cardholder_name'] ?? 'Customer');
                            $item_details = htmlspecialchars(($row['payment_method'] ?? 'Online') . " (" . ($row['account_name'] ?? 'Details') . ")");
                            $total_price = htmlspecialchars($row['amount'] ?? '0.00');
                            $status = strtolower($row['status'] ?? 'pending');
                            
                            // Allocating colors depending on order node state
                            $badge_class = 'badge-pending';
                            if ($status == 'delivered' || $status == 'completed') $badge_class = 'badge-delivered';
                            if ($status == 'cancelled' || $status == 'rejected') $badge_class = 'badge-cancelled';
                        ?>
                            <tr>
                                <td style="font-weight: 700; color: #0f172a;">#<?php echo $order_id; ?></td>
                                
                                <td style="font-weight: 600; color: #334155;"><?php echo $billing_name; ?></td>
                                
                                <td style="max-width: 260px; line-height: 1.4; color: #64748b; font-size: 14px;"><?php echo $item_details; ?></td>
                                
                                <td style="font-weight: 700; color: #ff4b5c;">Rs. <?php echo $total_price; ?></td>
                                
                                <td>
                                    <span class="status-badge <?php echo $badge_class; ?>">
                                        <?php echo $status; ?>
                                    </span>
                                </td>
                                
                                <td style="text-align: center;">
                                    <a href="admin-invoice.php?order_id=<?php echo $order_id; ?>" class="btn-receipt" target="_blank">
                                        <i class="fas fa-file-invoice"></i> View Slip
                                    </a>
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