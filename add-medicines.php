<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Add New Medicine</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #ff4b5c; 
            --primary-dark: #0f172a; 
            --bg-light: #f8fafc; 
            --text-heading: #1e293b; 
            --white: #ffffff; 
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg-light); display: flex; }
        .sidebar { width: 280px; background-color: var(--primary-dark); height: 100vh; position: fixed; padding: 2.5rem 1.5rem; }
        .logo { color: var(--primary-red); font-size: 1.5rem; font-weight: 800; margin-bottom: 3rem; display: flex; align-items: center; gap: 12px; }
        .nav-links { list-style: none; }
        .nav-links li { margin-bottom: 0.5rem; }
        .nav-links a { color: #94a3b8; text-decoration: none; padding: 12px 16px; display: flex; align-items: center; gap: 12px; border-radius: 12px; font-size: 14px; font-weight: 500; }
        .nav-links a.active { background-color: var(--primary-red); color: var(--white); box-shadow: 0 10px 15px -3px rgba(255, 75, 92, 0.4); }
        .main-content { margin-left: 280px; width: calc(100% - 280px); padding: 40px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header h1 { font-size: 28px; font-weight: 600; color: var(--text-heading); }
        .btn-add { background: var(--primary-red); color: var(--white); padding: 12px 24px; border-radius: 50px; border: none; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 14px rgba(255, 75, 92, 0.39); }
        
        /* Form Premium Container */
        .form-container { background: var(--white); padding: 30px; border-radius: 15px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); max-width: 600px; margin-top: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 500; color: var(--text-heading); }
        .form-control { width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-family: inherit; outline: none; transition: 0.3s; color: #475569; }
        .form-control:focus { border-color: var(--primary-red); }
        .btn-submit { background: var(--primary-red); color: white; border: none; padding: 12px 30px; border-radius: 50px; font-weight: 600; cursor: pointer; box-shadow: 0 4px 14px rgba(255, 75, 92, 0.39); }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><i class="fas fa-paw"></i> PetSphere</div>
        <ul class="nav-links">
            <li><a href="dashboard.php"><i class="fas fa-th-large"></i> Dashboard</a></li>
            <li><a href="manage-pets.php"><i class="fas fa-store"></i> Manage Shop</a></li>
            <li><a href="vet-consults.php" class="active"><i class="fas fa-user-md"></i> Vet Consults</a></li>
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
        <div class="header">
            <div class="header-text">
                <h1>Add Medicine Stock</h1>
                <p style="color: #64748b;">Insert new items into the pharmacy stock</p>
            </div>
            <a href="dashboard-pharmacy.php" class="btn-add" style="background: red; box-shadow: none;">
                <i class="fas fa-arrow-left"></i> Back to Pharmacy
            </a>
        </div>

        <section class="form-container">
            <form action="insert-medicine.php" method="POST">
                <div class="form-group">
                    <label>Medicine ID</label>
                    <input type="text" name="m_id" class="form-control" placeholder="e.g. #M503" required>
                </div>

                <div class="form-group">
                    <label>Medicine Name</label>
                    <input type="text" name="m_name" class="form-control" placeholder="e.g. Calcium Tablets" required>
                </div>
                
                <div class="form-group">
                    <label>Category</label>
                    <select name="m_cat" class="form-control" required>
                        <option>Supplements</option>
                        <option>Antibiotics</option>
                        <option>Health Care</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="m_price" class="form-control" placeholder="e.g. $20.00" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="m_status" class="form-control" required>
                        <option value="Available">Available</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>

                <button type="submit" name="submit_medicine" class="btn-submit">
                    <i class="fas fa-save"></i> Save Medicine
                </button>
            </form>
        </section>
    </main>

</body>
</html>