<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Add New Pet</title>
    <link rel="stylesheet" href="vet-consult.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .main-content {
            display: block !important;
        }
        
        .header {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            width: 100% !important;
            margin-bottom: 30px !important;
        }
        
        /* Button ko force karne wali styling */
        .btn-add {
            margin-left: 520px !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            max-width: 600px;
            margin-top: 20px;
        }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: #1e293b; }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            outline: none;
        }
        .btn-submit {
            background: #ff4b5c;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="logo">
                <i class="fas fa-paw"></i> PetSphere
            </div>
            <ul class="nav-links">
                <li><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="manage-pets.php" class="active"><i class="fas fa-store"></i> Manage Shop</a></li>
                <li><a href="vet-consults.php"><i class="fas fa-user-md"></i> Vet Consults</a></li>
                <li><a href="dashboard-pharmacy.php"><i class="fas fa-pills"></i> Pharmacy</a></li>
                <li><a href="/FYP/admin-notifications.php"><i class="fas fa-bell"></i> Notifications</a></li>
                <li><a href="/FYP/admin-feedbacks.php"><i class="fas fa-comments"></i> Feedbacks</a></li>
                <li><a href="/FYP/admin-orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                <li><a href="/FYP/admin-shipping.php"><i class="fas fa-truck"></i> Shipping Logs</a></li>
                <li><a href="view-website.php"><i class="fas fa-globe"></i> View Website</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="header">
                <div class="header-text">
                    <h1>Add New Pet Entry</h1>
                    <p>Insert a new pet into your store inventory</p>
                </div>
                <a href="manage-pets.php" class="btn-add">
                    <i class="fas fa-arrow-left"></i> Back to Shop
                </a>
            </header>

            <section class="form-container">
                <form action="insert-pet.php" method="POST">
                    <div class="form-group">
                        <label>Pet Breed</label>
                        <input type="text" name="pet_breed" class="form-control" placeholder="e.g. German Shepherd" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" class="form-control" placeholder="e.g. Dogs" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Price</label>
                        <input type="text" name="price" class="form-control" placeholder="e.g. 1000" required>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="In Stock">In Stock</option>
                            <option value="Out of Stock">Out of Stock</option>
                        </select>
                    </div>

                    <button type="submit" name="submit_pet" class="btn-submit">
                        <i class="fas fa-save"></i> Save Pet
                    </button>
                </form>
            </section>
        </main>
    </div>

</body>
</html>