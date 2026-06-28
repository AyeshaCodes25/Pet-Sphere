<?php
// 1. Connection File Include Ki (Aapki config.php file link ho rahi h)
include('config.php');

// 2. Default Fetch Query (Agar filter nahi lagaya toh saara data show hoga)
$query = "SELECT * FROM `activity_history` WHERE 1=1";

// 3. BACKEND SEARCH / FILTER FUNCTIONALITY
if (isset($_GET['search_btn'])) {
    
    // Search Keyword Filter (Doctor Name ya Service Name ke liye)
    if (!empty($_GET['search_keyword'])) {
        $keyword = mysqli_real_escape_string($conn, $_GET['search_keyword']);
        $query .= " AND (`doctor_name` LIKE '%$keyword%' OR `service_name` LIKE '%$keyword%')";
    }
    
    // Service Category Filter
    if (!empty($_GET['category']) && $_GET['category'] != 'All Services') {
        $category = mysqli_real_escape_string($conn, $_GET['category']);
        $query .= " AND `service_category` = '$category'";
    }
    
    // Status Filter
    if (!empty($_GET['status'])) {
        $status = mysqli_real_escape_string($conn, $_GET['status']);
        $query .= " AND `status` = '$status'";
    }
}

// Taake sabse naya record sabse upar nazar aaye
$query .= " ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Activity History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="history-client.css">
</head>
<body>

    <div class="app-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">PetSphere</div>
            <nav class="menu-list">
                <a href="dashboard-client.php" class="menu-item"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="notification.php" class="menu-item"><i class="fas fa-bell"></i> Notifications</a>
                <a href="payment-client.php" class="menu-item"><i class="fas fa-credit-card"></i> Payments</a>
                <a href="#" class="menu-item active"><i class="fas fa-history"></i> History</a>
                <a href="client-orders.php" class="menu-item"><i class="fas fa-shopping-bag"></i> My Orders</a>
                <a href="website-client.php" class="menu-item"><i class="fas fa-globe"></i> View Website</a>
                <a href="logout-client.php" class="menu-item logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <main class="main-panel">
            <header class="content-header">
                <div class="title-group">
                    <h1>Activity History</h1>
                    <p>Track and manage your pet's past records</p>
                </div>
            </header>

            <form action="history-client.php" method="GET" class="data-card filter-container">
                <div class="filter-row">
                    <div class="input-field">
                        <label>Search Keyword</label>
                        <input type="text" name="search_keyword" value="<?php echo isset($_GET['search_keyword']) ? htmlspecialchars($_GET['search_keyword']) : ''; ?>" placeholder="Doctor name, service..." class="form-input">
                    </div>
                    <div class="input-field">
                        <label>Service Category</label>
                        <select name="category" class="form-input">
                            <option value="All Services">All Services</option>
                            <option value="Vaccination" <?php if(isset($_GET['category']) && $_GET['category'] == 'Vaccination') echo 'selected'; ?>>Vaccination</option>
                            <option value="Checkup" <?php if(isset($_GET['category']) && $_GET['category'] == 'Checkup') echo 'selected'; ?>>Checkup</option>
                            <option value="Surgery" <?php if(isset($_GET['category']) && $_GET['category'] == 'Surgery') echo 'selected'; ?>>Surgery</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>Status</label>
                        <select name="status" class="form-input">
                            <option value="Completed" <?php if(isset($_GET['status']) && $_GET['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
                            <option value="Cancelled" <?php if(isset($_GET['status']) && $_GET['status'] == 'Cancelled') echo 'selected'; ?>>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" name="search_btn" class="submit-red-btn filter-btn">Search</button>
                </div>
            </form>

            <div class="history-feed">
                <?php
                // Agar database mein data maujood hai toh loop chalega
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="data-card history-row">
                            <div class="date-tag">
                                <span class="day"><?php echo htmlspecialchars($row['history_day']); ?></span>
                                <span class="month"><?php echo htmlspecialchars($row['history_month']); ?></span>
                            </div>
                            <div class="details-form">
                                <div class="inline-field">
                                    <label>Service:</label>
                                    <input type="text" value="<?php echo htmlspecialchars($row['service_name']); ?>" readonly class="inline-input">
                                </div>
                                <div class="inline-field">
                                    <label>Doctor:</label>
                                    <input type="text" value="<?php echo htmlspecialchars($row['doctor_name']); ?>" readonly class="inline-input">
                                </div>
                            </div>
                            <div class="row-actions">
                                <span class="status-pill success"><?php echo htmlspecialchars($row['status']); ?></span>
                                <button class="icon-btn"><i class="fas fa-download"></i></button>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    // Agar filter karne par koi match na mile toh yeh classy alert aayega
                    echo "<div class='data-card' style='text-align: center; color: #888; padding: 40px;'>No history records found matching your filters.</div>";
                }
                ?>
            </div>
        </main>
    </div>

</body>
</html>