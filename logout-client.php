<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout | PetSphere</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="logout-client.css">
</head>
<body>

<div class="dashboard-container">
    
    <aside class="sidebar">
            <div class="sidebar-header">PetSphere</div>
            <nav class="menu-list">
                <a href="dashboard-client.php" class="menu-item"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="notification.php" class="menu-item"><i class="fas fa-bell"></i> Notifications</a>
                <a href="payment-client.php" class="menu-item"><i class="fas fa-credit-card"></i> Payments</a>
                <a href="history-client.php" class="menu-item"><i class="fas fa-history"></i> History</a>
                <a href="client-orders.php" class="menu-item"><i class="fas fa-shopping-bag"></i> My Orders</a>
                <a href="website-client.php" class="menu-item"><i class="fas fa-globe"></i> View Website</a>
                <a href="#" class="menu-item active"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>


    <main class="main-content">
        
        <header class="content-header">
            <h1 class="page-title">Account Logout</h1>
            <p class="page-subtitle">Manage your session termination securely</p>
        </header>

        <div class="pharmacy-style-card">
            <div class="logout-box-interior">
                <div class="logout-icon-accent">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
                <h2 class="confirmation-heading">Are you sure you want to logout?</h2>
                
                <form action="login.php" method="POST" class="logout-action-form">
                    <button type="submit" name="confirm_logout" class="btn-primary-red">
                        Yes, Logout
                    </button>
                    <a href="dashboard-client.php" class="btn-secondary-outline">
                        Cancel
                    </a>
                </form>
            </div>
        </div>

    </main>

</div>

</body>
</html>