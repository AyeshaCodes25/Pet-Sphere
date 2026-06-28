<?php
// --- 1. DATABASE CONNECTION & ACTIONS ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_sphere";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Action: Single Notification Delete karna
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM admin_notifications WHERE id = $delete_id");
    header("Location: admin-notifications.php");
    exit;
}

// Action: Sab ko Ek Sath Read Mark karna
if (isset($_GET['mark_all_read'])) {
    $conn->query("UPDATE admin_notifications SET is_read = 1");
    header("Location: admin-notifications.php");
    exit;
}

// Database se saari notifications nikalna
$result = $conn->query("SELECT * FROM admin_notifications ORDER BY updated_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Admin Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #f4f6f9; color: #333; }
        
        /* Sidebar Styling (PetSphere Style) */
        .sidebar { width: 260px; height: 100vh; background-color: #0f172a; color: white; padding: 20px; position: fixed; }
        .logo { color: #ff4b5c; font-size: 22px; font-weight: 700; margin-bottom: 40px; display: flex; align-items: center; gap: 10px; }
        .menu-list { list-style: none; display: flex; flex-direction: column; gap: 10px; }
        .menu-list a { display: flex; align-items: center; gap: 15px; color: #94a3b8; text-decoration: none; padding: 12px 15px; border-radius: 8px; transition: 0.3s; }
        .menu-list a:hover, .menu-list a.active { background-color: #ff4b5c; color: white; font-weight: 600; }
        
        /* Main Content Styling */
        .main-content { margin-left: 260px; flex: 1; padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { font-size: 28px; color: #1e293b; }
        .header p { color: #64748b; margin-top: 5px; }
        
        /* Premium Buttons */
        .btn { padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: 0.3s; }
        .btn-primary { background-color: #ff4b5c; color: white; }
        .btn-primary:hover { background-color: #e03e4d; }
        .btn-danger { background-color: #ffebee; color: #c62828; font-size: 16px; padding: 8px; border-radius: 6px; }
        .btn-danger:hover { background-color: #ffdde2; }
        
        /* Table / Box Sheet Styling */
        .table-container { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .noti-table { width: 100%; border-collapse: collapse; text-align: left; }
        .noti-table th { padding: 15px; color: #64748b; font-size: 14px; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
        .noti-table td { padding: 18px 15px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        
        /* Status Badges */
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
        .status-unread { background-color: rgba(255, 75, 92, 0.1); color: #ff4b5c; }
        .status-read { background-color: #e2e8f0; color: #64748b; }
        
        /* Alert Type Circles */
        .type-icon { width: 35px; height: 35px; border-radius: 50%; display: grid; place-items: center; font-size: 14px; }
        .type-success { background: #e8f5e9; color: #2e7d32; }
        .type-warning { background: #fff3e0; color: #ef6c00; }
        .type-danger { background: #ffebee; color: #c62828; }
        .type-info { background: #e3f2fd; color: #0d47a1; }

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
            <li><a href="admin-notifications.php" class="active"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="/FYP/admin-feedbacks.php"><i class="fas fa-comments"></i> Feedbacks</a></li>
                <li><a href="/FYP/admin-orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                <li><a href="/FYP/admin-shipping.php"><i class="fas fa-truck"></i> Shipping Logs</a></li>
             <li><a href="/FYP/view-website.php"><i class="fas fa-globe"></i> View Website</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Admin Notifications</h1>
                <p>System activities, logs, low stock warnings, and alerts.</p>
            </div>
            <?php if ($result->num_rows > 0) { ?>
                <a href="admin-notifications.php?mark_all_read=1" class="btn btn-primary">
                    <i class="fas fa-check-double"></i> Mark All as Read
                </a>
            <?php } ?>
        </div>

        <div class="table-container">
            <?php if ($result->num_rows == 0) { ?>
                <div class="empty-state">
                    <i class="fas fa-bell-slash" style="font-size: 40px; margin-bottom: 15px; display:block;"></i>
                    No notifications or logs found in the system.
                </div>
            <?php } else { ?>
                <table class="noti-table">
                    <thead>
                        <tr>
                            <th>TYPE</th>
                            <th>TITLE</th>
                            <th>DESCRIPTION</th>
                            <th>STATUS</th>
                            <th>DATE & TIME</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Icons mapping for design beauty
                        $icons = [
                            'success' => 'fa-check-circle',
                            'warning' => 'fa-exclamation-triangle',
                            'danger' => 'fa-trash-alt',
                            'info' => 'fa-info-circle'
                        ];

                        while ($row = $result->fetch_assoc()) { 
                            $type = $row['type'] ? $row['type'] : 'info';
                            $iconClass = isset($icons[$type]) ? $icons[$type] : 'fa-info-circle';
                        ?>
                            <tr>
                                <td>
                                    <div class="type-icon type-<?php echo $type; ?>">
                                        <i class="fas <?php echo $iconClass; ?>"></i>
                                    </div>
                                </td>
                                <td style="font-weight: 600; color: #1e293b;"><?php echo htmlspecialchars($row['title']); ?></td>
                                <td style="color: #475569; max-width: 300px;"><?php echo htmlspecialchars($row['description']); ?></td>
                                <td>
                                    <?php if ($row['is_read'] == 0) { ?>
                                        <span class="status-badge status-unread">New</span>
                                    <?php } else { ?>
                                        <span class="status-badge status-read">Read</span>
                                    <?php } ?>
                                </td>
                                <td style="color: #94a3b8; font-size: 13px;"><?php echo $row['updated_at']; ?></td>
                                <td>
                                    <a href="admin-notifications.php?delete_id=<?php echo $row['id']; ?>" 
                                       class="btn btn-danger" 
                                       onclick="return confirm('Are you sure you want to delete this log?');">
                                        <i class="fas fa-trash-alt"></i>
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