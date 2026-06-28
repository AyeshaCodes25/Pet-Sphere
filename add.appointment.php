<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Add Appointment</title>
    <link rel="stylesheet" href="vet-consult.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Form Box Premium Styling jo aapki theme se match karegi */
        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            max-width: 600px;
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #1e293b;
        }
        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-family: inherit;
            outline: none;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #ff4b5c;
        }
        .btn-submit {
            background: var(--primary-red);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 14px 0 rgba(255, 75, 92, 0.39);
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background: #e13d4d;
            transform: translateY(-2px);
        }
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
        <header class="header">
            <div class="header-text">
                <h1>Add New Doctor</h1>
                <p>Register a new doctor appointment option</p>
            </div>
            <a href="vet-consults.php" class="btn-add">
                <i class="fas fa-arrow-left"></i> Back to Consults
            </a>
        </header>

        <section class="form-container">
            <form action="insert-appointment.php" method="POST">
                <div class="form-group">
                    <label>Doctor ID</label>
                    <input type="text" name="doc_id" class="form-control" placeholder="e.g. V03" required>
                </div>

                <div class="form-group">
                    <label>Doctor Name</label>
                    <input type="text" name="doc_name" class="form-control" placeholder="e.g. Dr. Ali Khan" required>
                </div>
                
                <div class="form-group">
                    <label>Specialization</label>
                    <input type="text" name="doc_spec" class="form-control" placeholder="e.g. General Physician" required>
                </div>
                
                <div class="form-group">
                    <label>Consultation Fee</label>
                    <input type="text" name="doc_fee" class="form-control" placeholder="e.g. 1000" required>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="doc_status" class="form-control" required>
                        <option value="Available">Available</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                </div>

                <button type="submit" name="submit_appointment" class="btn-submit">
                    <i class="fas fa-save"></i> Save Doctor
                </button>
            </form>
        </section>
    </main>

</body>
</html>