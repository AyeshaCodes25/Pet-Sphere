<?php
// 1. Connection File Include Ki
include('config.php');

$message = "";

// 2. BACKEND DELETE WORK (Jab koi delete button par click kare)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_notif'])) {
    $delete_id = (int)$_POST['delete_id'];
    
    // Database se row ko delete karne ki query
    $delete_query = "DELETE FROM `notifications` WHERE `id` = $delete_id";
    
    if (mysqli_query($conn, $delete_query)) {
        $message = "Notification Deleted Successfully!";
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}

// 3. BACKEND INSERT / UPDATE WORK (Save Changes Button Trigger)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_notifications'])) {
    
    // Card 1 Data
    $title1 = mysqli_real_escape_string($conn, $_POST['title1'] ?? '');
    $desc1 = mysqli_real_escape_string($conn, $_POST['desc1'] ?? '');
    
    // Card 2 Data
    $title2 = mysqli_real_escape_string($conn, $_POST['title2'] ?? '');
    $desc2 = mysqli_real_escape_string($conn, $_POST['desc2'] ?? '');
    
    // Pehle Card ko save ya update karne ki query (ID = 1)
    $query1 = "INSERT INTO `notifications` (`id`, `title`, `description`, `updated_at`) 
               VALUES (1, '$title1', '$desc1', NOW()) 
               ON DUPLICATE KEY UPDATE `title` = '$title1', `description` = '$desc1', `updated_at` = NOW()";
               
    // Doosre Card ko save ya update karne ki query (ID = 2)
    $query2 = "INSERT INTO `notifications` (`id`, `title`, `description`, `updated_at`) 
               VALUES (2, '$title2', '$desc2', NOW()) 
               ON DUPLICATE KEY UPDATE `title` = '$title2', `description` = '$desc2', `updated_at` = NOW()";
               
    if (mysqli_query($conn, $query1) && mysqli_query($conn, $query2)) {
        $message = "Changes Saved Successfully to Database!";
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}

// 4. FETCH EXISTING DATA (Default fallbacks lagaye hain agar row delete ho chuki ho)
$t1_val = "Notification Deleted";
$d1_val = "This notification has been removed from the database.";
$card1_exists = false;

$t2_val = "Notification Deleted";
$d2_val = "This notification has been removed from the database.";
$card2_exists = false;

$fetch_query = "SELECT * FROM `notifications` WHERE `id` IN (1, 2)";
$fetch_result = mysqli_query($conn, $fetch_query);

if ($fetch_result && mysqli_num_rows($fetch_result) > 0) {
    while ($row = mysqli_fetch_assoc($fetch_result)) {
        if ($row['id'] == 1) {
            $t1_val = $row['title'];
            $d1_val = $row['description'];
            $card1_exists = true; // Flag true kiya taake card active rahe
        }
        if ($row['id'] == 2) {
            $t2_val = $row['title'];
            $d2_val = $row['description'];
            $card2_exists = true; // Flag true kiya taake card active rahe
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Notifications Fixed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="notification.css">
</head>
<body>

    <div class="app-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">PetSphere</div>
            <nav class="menu-list">
                <a href="dashboard-client.php" class="menu-item"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="#" class="menu-item active"><i class="fas fa-bell"></i> Notifications</a>
                <a href="payment-client.php" class="menu-item"><i class="fas fa-credit-card"></i> Payments</a>
                <a href="history-client.php" class="menu-item"><i class="fas fa-history"></i> History</a>
                <a href="client-orders.php" class="menu-item"><i class="fas fa-shopping-bag"></i> My Orders</a>
                <a href="website-client.php" class="menu-item"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout-client.php" class="menu-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="main-panel">
            <?php if (!empty($message)): ?>
                <div id="success-alert" style="padding: 10px; margin-bottom: 15px; background: #e8f5e9; color: #2e7d32; border-radius: 5px; font-weight: 500;">
                    <?php echo $message; ?>
                </div>
                <script>
                    setTimeout(() => {
                        document.getElementById('success-alert').style.display = 'none';
                    }, 3000);
                </script>
            <?php endif; ?>

            <form id="notif-form" action="notification.php" method="POST">
                <header class="content-header">
                    <div class="title-group">
                        <h1>Notifications</h1>
                        <p>Manage your pet's updates</p>
                    </div>
                    <input type="hidden" name="save_notifications" value="1">
                    <button type="submit" class="mark-all-btn">Save Changes</button>
                </header>

                <div class="notif-feed">
                    
                    <div class="notif-card unread" style="<?php echo !$card1_exists ? 'opacity: 0.6;' : ''; ?>">
                        <input type="checkbox" checked class="form-check">
                        <div class="icon-circle red-bg"><i class="fas fa-calendar-alt"></i></div>
                        <div class="notif-text" style="flex: 1;">
                            <div class="notif-meta">
                                <input type="text" name="title1" id="title-1" value="<?php echo htmlspecialchars($t1_val); ?>" class="edit-title" <?php echo !$card1_exists ? 'disabled' : ''; ?> required>
                                <span class="time-stamp">Now</span>
                            </div>
                            <textarea name="desc1" id="desc-1" class="edit-desc" <?php echo !$card1_exists ? 'disabled' : ''; ?> required><?php echo htmlspecialchars($d1_val); ?></textarea>
                        </div>
                        
                        <?php if($card1_exists): ?>
                        <button type="submit" name="delete_notif" value="1" onclick="return confirm('Are you sure you want to delete this notification?');" style="background:none; border:none; color:#e74c3c; cursor:pointer; padding:5px;">
                            <input type="hidden" name="delete_id" value="1">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <?php endif; ?>
                    </div>

                    <div class="notif-card" style="<?php echo !$card2_exists ? 'opacity: 0.6;' : ''; ?>">
                        <input type="checkbox" class="form-check">
                        <div class="icon-circle blue-bg"><i class="fas fa-box"></i></div>
                        <div class="notif-text" style="flex: 1;">
                            <div class="notif-meta">
                                <input type="text" name="title2" id="title-2" value="<?php echo htmlspecialchars($t2_val); ?>" class="edit-title" <?php echo !$card2_exists ? 'disabled' : ''; ?> required>
                                <span class="time-stamp">3h ago</span>
                            </div>
                            <textarea name="desc2" id="desc-2" class="edit-desc" <?php echo !$card2_exists ? 'disabled' : ''; ?> required><?php echo htmlspecialchars($d2_val); ?></textarea>
                        </div>
                        
                        <?php if($card2_exists): ?>
                        <button type="submit" name="delete_notif" value="1" onclick="return confirm('Are you sure you want to delete this notification?');" style="background:none; border:none; color:#e74c3c; cursor:pointer; padding:5px;">
                            <input type="hidden" name="delete_id" value="2">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </main>
    </div>

</body>
</html>