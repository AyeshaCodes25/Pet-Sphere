<?php
// Step 1: Database connection file include ki
include('config.php');

// Step 2: Database se manage_pet_shop table ka data nikalne ki query run ki
$query = "SELECT * FROM `manage_pet_shop`";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Manage Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* --- PREMIUM CSS INTEGRATION --- */
        :root {
            --primary-red: #ff4b5c; 
            --primary-dark: #0f172a; 
            --sidebar-hover: rgba(255, 75, 92, 0.1); 
            --bg-light: #f8fafc; 
            --border-color: #e2e8f0; 
            --text-heading: #1e293b; 
            --text-body: #64748b; 
            --white: #ffffff; 
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif; 
        }

        body {
            background-color: var(--bg-light); 
            display: flex;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 280px; 
            background-color: var(--primary-dark); 
            height: 100vh;
            position: fixed;
            padding: 2.5rem 1.5rem; 
        }

        .logo {
            color: var(--primary-red); 
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .nav-links {
            list-style: none; 
        }

        .nav-links li { margin-bottom: 0.5rem; }

        .nav-links a {
            color: #94a3b8; 
            text-decoration: none;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-links a.active {
            background-color: var(--primary-red);
            color: var(--white);
            box-shadow: 0 10px 15px -3px rgba(255, 75, 92, 0.4);
        }

        /* --- MAIN CONTENT AREA --- */
        .main-content {
            margin-left: 280px; 
            width: calc(100% - 280px);
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            font-weight: 600; 
            color: var(--text-heading);
        }

        /* Capsule Button */
        .btn-add {
            background: var(--primary-red); 
            color: var(--white);
            padding: 12px 24px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(255, 75, 92, 0.39);
        }

        /* --- TABLE CARD --- */
        .table-card {
            background: var(--white); 
            padding: 30px;
            border-radius: 15px; 
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        /* Header Row Layout */
        .form-header-row {
            display: grid;
            grid-template-columns: 0.8fr 2fr 1.5fr 1fr 1fr 1fr;
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            color: #64748b; 
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Data Entry Row Layout */
        .form-data-row {
            display: grid;
            grid-template-columns: 0.8fr 2fr 1.5fr 1fr 1fr 1fr;
            padding: 20px 15px;
            border-bottom: 1px solid #f1f5f9;
            align-items: center;
        }

        /* Input Styling */
        .form-data-row input, .form-data-row select {
            border: none;
            background: transparent;
            font-size: 15px;
            color: #475569;
            outline: none;
            width: 100%;
        }

        .row-id input { color: #64748b; font-weight: 500; }
        .row-name input { color: #1e3a8a; font-weight: 700; } 

        /* Badge Styling */
        .badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            background: #dcfce7;
            color: #166534;
            display: inline-block;
        }

        /* Action Icons Cell */
        .actions-cell {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .actions-cell button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .edit-icon { color: #3b82f6; cursor: pointer; transition: 0.2s; }
        .delete-icon { color: #ef4444; cursor: pointer; transition: 0.2s; }
        .edit-icon:hover, .delete-icon:hover { transform: scale(1.15); }

    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="logo"><i class="fas fa-paw"></i> PetSphere</div>
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
        <div class="header">
            <div class="header-text">
                <h1>Manage Pet Shop</h1>
                <p style="color: #64748b;">Manage available pets, breeds, and categories</p>
            </div>
            <a href="add-pet.php" class="btn-add">
                <i class="fas fa-plus"></i> Add New Pet
            </a>
        </div>

        <section class="table-card">
            <form action="update-pet.php" method="POST">
                
                <div class="form-header-row">
                    <div>ID</div>
                    <div>Pet Breed</div>
                    <div>Category</div>
                    <div>Price</div>
                    <div>Status</div>
                    <div>Action</div>
                </div>

                <?php
                // Step 3: PHP Loop lagaya jo database se pets nikalega
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="form-data-row">
                            <div class="row-id">
                                <input type="text" name="pet_id[]" value="<?php echo $row['ID']; ?>" readonly>
                            </div>
                            <div class="row-name">
                                <input type="text" name="pet_breed[]" value="<?php echo $row['Pet_Breed']; ?>">
                            </div>
                            <div>
                                <select name="pet_category[]">
                                    <option <?php if($row['Category'] == 'Dogs') echo 'selected'; ?>>Dogs</option>
                                    <option <?php if($row['Category'] == 'Cats') echo 'selected'; ?>>Cats</option>
                                    <option <?php if($row['Category'] == 'Birds') echo 'selected'; ?>>Birds</option>
                                </select>
                            </div>
                            <div>
                                <input type="text" name="pet_price[]" value="<?php echo $row['Price']; ?>">
                            </div>
                            <div>
                                <span class="badge"><?php echo $row['Status']; ?></span>
                                <input type="hidden" name="pet_status[]" value="<?php echo $row['Status']; ?>">
                            </div>
                            <div class="actions-cell">
                                <button type="submit">
                                    <i class="fas fa-edit edit-icon"></i>
                                </button>
                                <i class="fas fa-trash delete-icon" onclick="ajaxDeleteRow(this, '<?php echo $row['ID']; ?>')"></i>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    // Agar database khali hoga toh yeh message dikhega
                    echo "<p style='padding: 30px; text-align: center; color: #64748b;'>No pets found in shop. Click 'Add New Pet' to insert data.</p>";
                }
                // Connection close kiya
                mysqli_close($conn);
                ?>
            </form>
        </section>
    </main>

    <script>
    function ajaxDeleteRow(element, id) {
        if (confirm("Are you sure you want to delete this pet?")) {
            // Background mein delete-pet.php file hit hogi bina page reload kiye
            fetch('delete-pet.php?id=' + encodeURIComponent(id), {
                method: 'GET'
            })
            .then(response => {
                let row = element.closest('.form-data-row');
                if (row) {
                    row.remove();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Try again');
            });
        }
    }
    </script>

</body>
</html>