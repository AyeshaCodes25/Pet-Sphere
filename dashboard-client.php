<?php
// 1. Connection File Include Ki
include('config.php');

$message = "";

// 2. INSERT WORK (Quick Feedback Form Submit)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['review_text'])) {
    
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $review_text = mysqli_real_escape_string($conn, $_POST['review_text']);
    
    // Auto-increment na hone ki wajah se random ID bhej rahe hain
    $random_id = rand(1, 999999);
    
    // Query exact database columns ke mutabiq hai
    $insert_query = "INSERT INTO `reviews` (`id`, `rating`, `review_text`, `created_at`) VALUES ('$random_id', '$rating', '$review_text', NOW())";
    
    if (mysqli_query($conn, $insert_query)) {
        echo "<script type='text/javascript'>
                alert('Review Submitted Successfully!');
                window.location.href='dashboard-client.php';
              </script>";
        exit();
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}

// 3. BACKEND UPDATE WORK (Recent Updates Table Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_recent'])) {
    $row_id = (int)$_POST['row_id'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $details = mysqli_real_escape_string($conn, $_POST['details']);
    
    $update_query = "UPDATE `recent_updates` SET `status` = '$status', `details` = '$details' WHERE `id` = $row_id";
    if (mysqli_query($conn, $update_query)) {
        $message = "Recent Update Changed Successfully!";
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}

// 4. BACKEND DELETE WORK (Recent Updates Table Delete)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_recent'])) {
    $row_id = (int)$_POST['row_id'];
    
    $delete_query = "DELETE FROM `recent_updates` WHERE `id` = $row_id";
    if (mysqli_query($conn, $delete_query)) {
        $message = "Recent Update Removed Successfully!";
    } else {
        die("Database Error: " . mysqli_error($conn));
    }
}

// 5. FETCH DATA (Outstanding Amount) - SAFE CHECK WITH TRY-CATCH
$outstanding_amount = 15500; // Default fallback amount agar table na ho

try {
    $amt_query = "SELECT SUM(fee_amount) AS total FROM `client_billing` WHERE `status` = 'Pending'"; 
    $amt_result = mysqli_query($conn, $amt_query);

    if ($amt_result && mysqli_num_rows($amt_result) > 0) {
        $amt_row = mysqli_fetch_assoc($amt_result);
        if (!empty($amt_row['total'])) {
            $outstanding_amount = $amt_row['total'];
        }
    }
} catch (Exception $e) {
    $outstanding_amount = 15500; 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Client Dashboard Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard-client.css">
</head>
<body>

    <div class="app-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-paw"></i>
                <span>PetSphere</span>
            </div>
            
            <nav class="menu-list">
                <a href="dashboard-client.php" class="menu-item active"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="notification.php" class="menu-item"><i class="fas fa-bell"></i> Notifications</a>
                <a href="payment-client.php" class="menu-item"><i class="fas fa-credit-card"></i> Payments</a>
                <a href="history-client.php" class="menu-item"><i class="fas fa-history"></i> History</a>
                <a href="client-orders.php" class="menu-item"><i class="fas fa-shopping-bag"></i> My Orders</a>
                <a href="view-website.php" class="menu-item"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout-client.php" class="menu-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="main-panel">
            <header class="header">
                <h2>Client Dashboard</h2>
                <div class="user-meta">
                    <input type="text" value="Client-panel" class="inline-edit-input" readonly>
                </div>
            </header>

            <?php if (!empty($message)): ?>
                <div id="success-alert" style="padding: 10px; margin-bottom: 20px; background: #e8f5e9; color: #2e7d32; border-radius: 8px; font-weight: 500;">
                    <i class="fas fa-check-circle"></i> <?php echo $message; ?>
                </div>
                <script>
                    setTimeout(() => { document.getElementById('success-alert').style.display = 'none'; }, 3000);
                </script>
            <?php endif; ?>

            <div class="dashboard-grid">
                
                <div class="data-card">
                    <div class="card-top">
                        <span class="card-label">Outstanding Amount</span>
                    </div>
                    <div class="input-with-icon">
                        <span class="currency-tag">Rs.</span>
                        <input type="number" class="val-input" value="<?php echo $outstanding_amount; ?>" readonly>
                    </div>
                    <div class="field-group">
                        <label>Last Activity Note</label>
                        <input type="text" class="desc-input" value="Vet Consultation fee paid." readonly>
                    </div>
                    <button type="button" onclick="window.location.href='payment-client.php'" class="submit-red-btn" style="margin-top: 15px;">+ Pay Now</button>
                </div>

                <div class="data-card">
                    <h3>Recent Updates</h3>
                    
                    <?php
                    // Database se updates fetch karne ka logic fallbacks ke sath
                    $updates = [
                        ['id' => 1, 'status' => 'Confirmed', 'details' => 'Appointment with Dr. Sarah Ahmed'],
                        ['id' => 2, 'status' => 'Pending', 'details' => 'Medicine Order #102 in transit']
                    ];
                    
                    try {
                        $up_query = "SELECT * FROM `recent_updates` LIMIT 5";
                        $up_result = mysqli_query($conn, $up_query);
                        if ($up_result && mysqli_num_rows($up_result) > 0) {
                            $updates = []; // Agar database me records hain toh dummy data clear kar dein
                            while($row = mysqli_fetch_assoc($up_result)) {
                                $updates[] = $row;
                            }
                        }
                    } catch (Exception $e) {
                        // Table nahi bani hui toh fallback array upar wala hi chalega
                    }

                    foreach ($updates as $up):
                        $status_class = (strtolower($up['status']) == 'confirmed') ? 'confirmed' : 'pending';
                    ?>
                    <div class="form-notif-row" style="position: relative;">
                        <form action="" method="POST" style="display: flex; flex-direction: column; gap: 8px; width: 100%;">
                            <input type="hidden" name="row_id" value="<?php echo $up['id']; ?>">
                            
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <select name="status" class="status-select <?php echo $status_class; ?>">
                                    <option value="Confirmed" <?php echo ($up['status'] == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                                    <option value="Pending" <?php echo ($up['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                </select>
                                
                                <div style="display: flex; gap: 10px;">
                                    <button type="submit" name="update_recent" title="Save Changes" style="background: none; border: none; color: #4b5563; cursor: pointer;">
                                        <i class="fas fa-save"></i>
                                    </button>
                                    <button type="submit" name="delete_recent" title="Delete Row" onclick="return confirm('Remove this record?');" style="background: none; border: none; color: #e63946; cursor: pointer;">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <input type="text" name="details" value="<?php echo htmlspecialchars($up['details']); ?>" class="row-input">
                        </form>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="data-card">
                    <h3>Quick Feedback</h3>
                    <form action="" method="POST">
                        <div class="stars-input">
                            <select name="rating" class="rating-dropdown" required>
                                <option value="5 ⭐">⭐⭐⭐⭐⭐ (Excellent)</option>
                                <option value="4 ⭐" selected>⭐⭐⭐⭐ (Good)</option>
                                <option value="3 ⭐">⭐⭐⭐ (Average)</option>
                                <option value="2 ⭐">⭐⭐ (Poor)</option>
                            </select>
                        </div>
                        <textarea name="review_text" placeholder="Write your experience..." required>Great service, very satisfied with the vet!</textarea>
                        <button type="submit" class="submit-red-btn" style="margin-top: 15px;">Submit Review</button>
                    </form>
                </div>

            </div>
        </main>
    </div>

</body>
</html>