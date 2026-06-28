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

// Action: Agar admin kisi faltu ya bad-tameez feedback ko delete karna chahe
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->query("DELETE FROM reviews WHERE id = $delete_id");
    header("Location: admin-feedbacks.php");
    exit;
}

// Database se saare reviews nikalna (Naye reviews sabse upar dikhenge)
// Note: Agar aapke table mein user ka naam nikalne ke liye user_id h to join lag sakta h, 
// abhi hum direct reviews table ka data fetch kar rahe hain.
$result = $conn->query("SELECT * FROM reviews ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Client Feedbacks</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; background-color: #f4f6f9; color: #333; }
        
        /* Sidebar Styling (PetSphere Identical Theme) */
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
        
        /* Delete Button */
        .btn-danger { background-color: #ffebee; color: #c62828; font-size: 16px; padding: 8px; border-radius: 6px; border: none; cursor: pointer; transition: 0.3s; display: inline-flex; align-items: center; }
        .btn-danger:hover { background-color: #ffdde2; }
        
        /* Table Layout Box Sheet */
        .table-container { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
        .feedback-table { width: 100%; border-collapse: collapse; text-align: left; }
        .feedback-table th { padding: 15px; color: #64748b; font-size: 14px; font-weight: 600; border-bottom: 2px solid #e2e8f0; }
        .feedback-table td { padding: 18px 15px; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
        
        /* Stars Rating Color */
        .stars-container { color: #ffc107; font-size: 14px; display: flex; gap: 3px; }
        
        /* User Initial Avatar */
        .user-avatar { width: 36px; height: 36px; background-color: #e2e8f0; color: #475569; border-radius: 50%; display: grid; place-items: center; font-weight: 600; font-size: 14px; }
        
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
            <li><a href="admin-feedbacks.php" class="active"><i class="fas fa-comments"></i> Feedbacks</a></li>
            <li><a href="/FYP/admin-orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
             <li><a href="/FYP/admin-shipping.php"><i class="fas fa-truck"></i> Shipping Logs</a></li>
              <li><a href="/FYP/view-website.php"><i class="fas fa-globe"></i> View Website</a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Client Feedbacks & Reviews</h1>
                <p>Read what your customers are saying about PetSphere services and products.</p>
            </div>
        </div>

        <div class="table-container">
            <?php if ($result->num_rows == 0) { ?>
                <div class="empty-state">
                    <i class="far fa-comments" style="font-size: 40px; margin-bottom: 15px; display:block; color: #94a3b8;"></i>
                    No feedback or reviews submitted yet.
                </div>
            <?php } else { ?>
                <table class="feedback-table">
                    <thead>
                        <tr>
                            <th>USER</th>
                            <th>RATING</th>
                            <th>COMMENT / FEEDBACK</th>
                            <th>DATE submitted</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        while ($row = $result->fetch_assoc()) { 
                            // Agar table m user ka direct name na ho to 'Client' show hoga
                            $client_name = isset($row['user_name']) ? $row['user_name'] : (isset($row['name']) ? $row['name'] : 'Pet Client');
                            $initial = strtoupper(substr($client_name, 0, 1));
                            
                            // Rating stars generate karne ke liye loop logic
                            $rating = isset($row['rating']) ? intval($row['rating']) : 5;
                        ?>
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div class="user-avatar"><?php echo $initial; ?></div>
                                        <div style="font-weight: 600; color: #1e293b;"><?php echo htmlspecialchars($client_name); ?></div>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="stars-container">
                                        <?php 
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="fas fa-star"></i>';
                                            } else {
                                                echo '<i class="far fa-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </td>
                                
                                <td style="color: #475569; max-width: 350px; line-height: 1.5;">
                                    <?php echo htmlspecialchars($row['review_text'] ?? $row['comment'] ?? $row['feedback'] ?? 'No text provided.'); ?>
                                </td>
                                
                                <td style="color: #94a3b8; font-size: 13px;">
                                    <?php echo isset($row['created_at']) ? $row['created_at'] : (isset($row['date']) ? $row['date'] : 'Recent'); ?>
                                </td>
                                
                                <td>
                                    <a href="admin-feedbacks.php?delete_id=<?php echo $row['id']; ?>" 
                                       class="btn btn-danger" 
                                       onclick="return confirm('Are you sure you want to delete this feedback?');">
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