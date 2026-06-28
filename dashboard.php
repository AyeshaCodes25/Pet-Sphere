<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
     /* style.css - Premium Edition */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

:root {
    /* Color Palette */
    --primary-red: #ff4b5c;
    --primary-dark: #0f172a;
    --sidebar-hover: rgba(255, 75, 92, 0.1);
    --bg-light: #f8fafc;
    --card-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.04), 0 8px 10px -6px rgba(0, 0, 0, 0.04);
    --border-color: #e2e8f0;
    --text-heading: #1e293b;
    --text-body: #64748b;
    --white: #ffffff;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif; /* Cleaner, more professional font */
}

body {
    background-color: var(--bg-light);
    color: var(--text-body);
    line-height: 1.6;
}

.dashboard-container {
    display: flex;
    min-height: 100vh;
}

/* --- SIDEBAR UPGRADE --- */
.sidebar {
    width: 280px;
    background-color: var(--primary-dark);
    padding: 2.5rem 1.5rem;
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    z-index: 10; 
}

/* Active State Styling */
.nav-links li.active a {
    background-color: #f0627d !important; /* Image 71d9e0b6... wala red color */
    color: white !important;
}

.logo {
    color: var(--primary-red);
    font-size: 1.5rem;
    font-weight: 800;
    margin-bottom: 3rem;
    display: flex;
    align-items: center;
    gap: 12px;
    letter-spacing: -0.5px;
}

.nav-links {
    list-style: none;
}

.nav-links li {
    margin-bottom: 0.5rem;
}

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
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.nav-links a i {
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
}

.nav-links a:hover, .nav-links a.active {
    background-color: var(--sidebar-hover);
    color: var(--white);
}

.nav-links a.active {
    background-color: var(--primary-red);
    box-shadow: 0 10px 15px -3px rgba(255, 75, 92, 0.4);
}
        /* --- MAIN CONTENT AREA --- */
        .main-content {
            margin-left: 280px; /* Sidebar ki width ke mutabiq gap set kiya */
            width: calc(100% - 280px);
            padding: 40px;
            position: relative;
            z-index: 1; 
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 { font-size: 28px; color: #333; }
        .admin-profile { display: flex; align-items: center; gap: 10px; }
        .avatar { width: 40px; height: 40px; background: #ff4d4d; border-radius: 50%; display: grid; place-items: center; color: white; font-weight: bold; }

        /* --- STAT CARDS (Professional Arrangement) --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
            clear: both;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            text-align: center;
            border-bottom: 4px solid transparent;
            transition: 0.3s;
        }

        .stat-card:hover { border-bottom: 4px solid #ff4d4d; transform: translateY(-5px); }
        .stat-card i { font-size: 25px; color: #ff4d4d; background: rgba(255,77,77,0.1); padding: 15px; border-radius: 50%; margin-bottom: 15px; }
        .stat-card h3 { font-size: 24px; color: #2c3e50; margin-bottom: 5px; }
        .stat-card p { color: #7f8c8d; font-size: 14px; }

        /* --- TABLE SECTION --- */
        .recent-section {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            position: relative;
            z-index: 5;
        }

        .table-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .view-all-btn { 
            background: #ff4d4d; 
            color: white; 
            border: none; 
            padding: 8px 15px; 
            border-radius: 5px; 
            cursor: pointer; 
            position: relative;
            z-index: 10;
            font-weight: 500;
            transition: background 0.2s;
        }
        .view-all-btn:hover {
            background: #e04343;
        }

        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px; color: #7f8c8d; border-bottom: 1px solid #eee; }
        td { padding: 15px 12px; border-bottom: 1px solid #fafafa; color: #333; }

        .status-badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            background: #e8f5e9;
            color: #2e7d32;
        }

        /* --- MODAL (POPUP) STYLING --- */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 80%;
            max-width: 800px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .modal-header h2 {
            color: #2c3e50;
            font-size: 22px;
        }

        .close-modal-btn {
            background: none;
            border: none;
            font-size: 24px;
            color: #888;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close-modal-btn:hover {
            color: #ff4d4d;
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <nav class="sidebar">
            <div class="logo">
                <i class="fas fa-paw"></i> PetSphere
            </div>
            <ul class="nav-links">
                <li><a href="/FYP/dashboard.php" class="active"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="/FYP/manage-pets.php"><i class="fas fa-store"></i> Manage Shop</a></li>
                <li><a href="/FYP/vet-consults.php"><i class="fas fa-user-md"></i> Vet Consults</a></li>
                <li><a href="/FYP/dashboard-pharmacy.php"><i class="fas fa-pills"></i> Pharmacy</a></li>
                <li><a href="/FYP/admin-notifications.php"><i class="fas fa-bell"></i> Notifications</a></li>
                <li><a href="/FYP/admin-feedbacks.php"><i class="fas fa-comments"></i> Feedbacks</a></li>
                <li><a href="/FYP/admin-orders.php"><i class="fas fa-shopping-cart"></i> Orders</a></li>
                <li><a href="/FYP/admin-shipping.php"><i class="fas fa-truck"></i> Shipping Logs</a></li>
                <li><a href="/FYP/view-website.php"><i class="fas fa-globe"></i> View Website</a></li>
                <li><a href="/FYP/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>

        <div class="main-content">
            <div class="header">
                <div>
                    <p style="color: #888;">Hello, Admin</p>
                    <h1>System Overview</h1>
                </div>
                <div class="admin-profile">
                    <div class="avatar">AD</div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <i class="fas fa-dog"></i>
                    <h3>124</h3>
                    <p>Total Pets Listed</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>42</h3>
                    <p>Vet Appointments</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-capsules"></i>
                    <h3>850</h3>
                    <p>Medicine Stock</p>
                </div>
                <div class="stat-card">
                    <i class="fas fa-users"></i>
                    <h3>1,200</h3>
                    <p>Total Users</p>
                </div>
            </div>

            <div class="recent-section">
                <div class="table-title">
                    <h3>Recent Activities</h3>
                    <button class="view-all-btn" id="openModalBtn">View All</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Category</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ali Khan</td>
                            <td>Pharmacy</td>
                            <td>Ordered Paracetamol</td>
                            <td><span class="status-badge">Delivered</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="activitiesModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>All Recent Activities</h2>
                <button class="close-modal-btn" id="closeModalBtn">&times;</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Category</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ali Khan</td>
                        <td>Pharmacy</td>
                        <td>Ordered Paracetamol</td>
                        <td><span class="status-badge">Delivered</span></td>
                    </tr>
                    <tr>
                        <td>Sana Ahmed</td>
                        <td>Vet Consults</td>
                        <td>Booked Appointment</td>
                        <td><span class="status-badge" style="background: #e3f2fd; color: #0d47a1;">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Zain Malik</td>
                        <td>Manage Shop</td>
                        <td>Purchased Persian Cat</td>
                        <td><span class="status-badge">Delivered</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Modal toggling script
        const modal = document.getElementById('activitiesModal');
        const openBtn = document.getElementById('openModalBtn');
        const closeBtn = document.getElementById('closeModalBtn');

        openBtn.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Agar modal se baahir kahin click ho toh bhi close ho jaye
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });
    </script>

</body>
</html>