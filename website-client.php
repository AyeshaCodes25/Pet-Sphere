<?php
// 1. Database Connection Include Ki (Aapki config.php link ho rahi h)
include('config.php');

// ==========================================
// 2. UPDATE FUNCTIONALITY (Jab user "Save Changes" dabaye)
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Input fields se data lekar secure kiya taake SQL injection na ho
    $title = mysqli_real_escape_string($conn, $_POST['web_title']);
    $email = mysqli_real_escape_string($conn, $_POST['web_email']);
    $about_desc = mysqli_real_escape_string($conn, $_POST['web_desc']);
    $fb_url = mysqli_real_escape_string($conn, $_POST['fb_url']);
    $insta_url = mysqli_real_escape_string($conn, $_POST['insta_url']);
    $theme_color = mysqli_real_escape_string($conn, $_POST['theme_color']);
    
    // Aaj ki date automate kar di format ke mutabiq (e.g., May 18, 2026)
    $current_date = date('M d, Y'); 

    // Query: Hamesha ID 1 wale record ko hi update karega
    $update_query = "UPDATE `website_settings` SET 
                        `title` = '$title', 
                        `email` = '$email', 
                        `about_desc` = '$about_desc', 
                        `facebook_url` = '$fb_url', 
                        `instagram_url` = '$insta_url', 
                        `theme_color` = '$theme_color',
                        `last_updated` = '$current_date' 
                    WHERE `id` = 1";

    if (mysqli_query($conn, $update_query)) {
        // Success alert aur page reload taake naya data foran nazar aaye
        echo "<script>alert('Website settings updated successfully!'); window.location.href='website-client.php';</script>";
    } else {
        echo "<script>alert('Error updating settings: " . mysqli_error($conn) . "');</script>";
    }
}

// ==========================================
// 3. FETCHING FUNCTIONALITY (Page load hote hi data dikhane ke liye)
// ==========================================
$fetch_query = "SELECT * FROM `website_settings` WHERE `id` = 1";
$settings_result = mysqli_query($conn, $fetch_query);
$settings = mysqli_fetch_assoc($settings_result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | View Website Settings</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="website-client.css">
</head>
<body>

    <div class="app-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">PetSphere</div>
            <nav class="menu-list">
                <a href="dashboard-client.php" class="menu-item"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="notification.php" class="menu-item"><i class="fas fa-bell"></i> Notifications</a>
                <a href="payment-client.php" class="menu-item"><i class="fas fa-credit-card"></i> Payments</a>
                <a href="history-client.php" class="menu-item"><i class="fas fa-history"></i> History</a>
                <a href="client-orders.php" class="menu-item"><i class="fas fa-shopping-bag"></i> My Orders</a>
                <a href="#" class="menu-item active"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout-client.php" class="menu-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="main-panel">
            <header class="content-header">
                <div class="title-group">
                    <h1>Website Configuration</h1>
                    <p>Manage how your website appears to the public</p>
                </div>
                <a href="https://yourwebsite.com" target="_blank" class="live-link-btn">
                    <i class="fas fa-external-link-alt"></i> Open Live Site
                </a>
            </header>

            <form action="website-client.php" method="POST">
                <div class="payment-grid">
                    <div class="forms-wrapper">
                        <div class="data-card">
                            <h3>General Information</h3>
                            <div class="field-group">
                                <label>Website Title</label>
                                <input type="text" name="web_title" value="<?php echo htmlspecialchars($settings['title']); ?>" class="form-input" required>
                            </div>
                            <div class="field-group">
                                <label>Contact Email</label>
                                <input type="email" name="web_email" value="<?php echo htmlspecialchars($settings['email']); ?>" class="form-input" required>
                            </div>
                            <div class="field-group">
                                <label>About Us Short Description</label>
                                <textarea name="web_desc" class="form-input" rows="4" required><?php echo htmlspecialchars($settings['about_desc']); ?></textarea>
                            </div>
                        </div>

                        <div class="data-card">
                            <h3>Social Media Links</h3>
                            <div class="form-row">
                                <div class="field-group">
                                    <label><i class="fab fa-facebook"></i> Facebook URL</label>
                                    <input type="text" name="fb_url" value="<?php echo htmlspecialchars($settings['facebook_url']); ?>" placeholder="https://facebook.com/..." class="form-input">
                                </div>
                                <div class="field-group">
                                    <label><i class="fab fa-instagram"></i> Instagram URL</label>
                                    <input type="text" name="insta_url" value="<?php echo htmlspecialchars($settings['instagram_url']); ?>" placeholder="https://instagram.com/..." class="form-input">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="side-panel">
                        <div class="data-card">
                            <h3>Publish Status</h3>
                            <div class="status-box">
                                <p><strong>Current Status:</strong> <span class="status-tag online">Live</span></p>
                                <p>Last Updated: <?php echo htmlspecialchars($settings['last_updated']); ?></p>
                            </div>
                            <button type="submit" class="submit-red-btn">Save Changes</button>
                        </div>

                        <div class="data-card">
                            <h3>Theme Color</h3>
                            <div class="color-picker-group">
                                <input type="color" name="theme_color" value="<?php echo htmlspecialchars($settings['theme_color']); ?>" id="primaryColor">
                                <span>Primary Theme Color</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>

</body>
</html>