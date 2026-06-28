<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Website | PetSphere</title>
    <!-- CSS file ka sahi path check karein -->
    <link rel="stylesheet" href="view-website.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="dashboard-wrapper">
    <!-- Sidebar Selection -->
    <nav class="sidebar">
        <div class="logo">
            <i class="fas fa-paw"></i> PetSphere
        </div>
        <ul class="nav-links">
            <li><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="manage-pets.php"><i class="fas fa-store"></i> Manage Shop</a></li>
                <li><a href="vet-consults.php"><i class="fas fa-user-md"></i> Vet Consults</a></li>
                <li><a href="dashboard-pharmacy.php"><i class="fas fa-pills"></i> Pharmacy</a></li>
            <li><a href="/FYP/admin-notifications.php"><i class="fas fa-bell"></i> Notifications</a></li>
            <li><a href="/FYP/admin-feedbacks.php"><i class="fas fa-comments"></i> Feedbacks</a></li>
            <li><a href="/FYP/admin-orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
             <li><a href="/FYP/admin-shipping.php"><i class="fas fa-truck"></i> Shipping Logs</a></li>
                <li><a href="view-website.php" class="active"><i class="fas fa-globe"></i> View Website</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </nav>
<main class="content">
    <div class="website-redirect-container">
        <div class="redirect-card">
            <div class="icon-circle">
                <i class="fas fa-globe"></i>
            </div>
            <h2>Visit Public Website</h2>
            <p>Click the button below to view the live PetSphere website as a customer. This will open the site in a new browser tab.</p>
            
            <a href="firstpage.php" target="_blank" class="visit-btn">
                Go to Website <i class="fas fa-external-link-alt"></i>
            </a>
            
            <div class="info-note">
                <i class="fas fa-info-circle"></i>
                <span>You can manage website content from the Shop and Pharmacy sections.</span>
            </div>
        </div>
    </div>
</main>
   
</body>
</html>