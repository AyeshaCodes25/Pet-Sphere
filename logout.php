<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout | PetSphere</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="logout.css">
</head>
<body>

<div class="dashboard-container">
    
    <aside class="sidebar">
        <div class="logo-section">
            <i class="fa-solid fa-paw logo-icon"></i>
            <span class="logo-text">PetSphere</span>
        </div>
        
        <nav class="nav-menu">
            <a href="dashboard.php" class="nav-item">
                <i class="fa-solid fa-table-columns"></i> <span>Dashboard</span>
            </a>
            <a href="manage-shop.php" class="nav-item">
                <i class="fa-solid fa-shop"></i> <span>Manage Shop</span>
            </a>
            <a href="vet-consults.php" class="nav-item">
                <i class="fa-solid fa-user-doctor"></i> <span>Vet Consults</span>
            </a>
            <a href="dashboard-pharmacy.php" class="nav-item">
                <i class="fa-solid fa-pills"></i> <span>Pharmacy</span>
            </a>
            <a href="/FYP/admin-notifications.php" class="nav-item"><i class="fas fa-bell"></i> 
            <span>Notifications</span></a>
            <a href="/FYP/admin-feedbacks.php" class="nav-item"><i class="fas fa-comments"></i> 
            <span>Feedbacks</span></a>
           <a href="/FYP/admin-orders.php" class="nav-item"><i class="fas fa-shopping-cart"></i> 
           <span>Orders</span></a>
             <a href="/FYP/admin-shipping.php" class="nav-item"><i class="fas fa-truck"></i> 
             <span>Shipping Logs</span></a>
            <a href="view-website.php" class="nav-item">
                <i class="fa-solid fa-globe"></i> <span>View Website</span>
            </a>
            <a href="logout.php" class="nav-item active">
                <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
            </a>
        
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
                <p class="confirmation-text">Aapka current session close ho jayega. Dobara access karne ke liye login karna parega.</p>
                
                <form action="login.php" method="POST" class="logout-action-form">
                    <button type="submit" name="confirm_logout" class="btn-primary-red">
                        Yes, Logout
                    </button>
                    <a href="dashboard.php" class="btn-secondary-outline">
                        Cancel
                    </a>
                </form>
            </div>
        </div>

    </main>

</div>

</body>
</html>