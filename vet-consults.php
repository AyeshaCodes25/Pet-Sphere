<?php
// Step 1: Database connection file include ki
include('config.php');

// ================= AUTOMATIC COLUMN FIX =================
$check_column = mysqli_query($conn, "SHOW COLUMNS FROM `appointments` LIKE 'status'");
if (mysqli_num_rows($check_column) == 0) {
    mysqli_query($conn, "ALTER TABLE `appointments` ADD `status` VARCHAR(20) DEFAULT 'Pending' AFTER `reason`");
}
// ========================================================

// ================= PATIENT APPOINTMENT UPDATE BACKEND =================
if (isset($_POST['update_patient_appointment'])) {
    $app_id = mysqli_real_escape_string($conn, $_POST['app_id']);
    $doctor_name = mysqli_real_escape_string($conn, $_POST['doctor_name']);
    $owner_name = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $pet_type = mysqli_real_escape_string($conn, $_POST['pet_type']);
    $app_status = mysqli_real_escape_string($conn, $_POST['app_status']);
    
    $update_query = "UPDATE `appointments` 
                     SET `doctor_name` = '$doctor_name', 
                         `owner_name` = '$owner_name', 
                         `pet_type` = '$pet_type', 
                         `status` = '$app_status' 
                     WHERE `id` = '$app_id'";
                     
    mysqli_query($conn, $update_query);
    header("Location: vet-consults.php");
    exit();
}

// Step 2: Database se data nikalne ki queries
$query = "SELECT * FROM `vet_consults`";
$result = mysqli_query($conn, $query);

$table_setup = "CREATE TABLE IF NOT EXISTS `appointments` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `doctor_name` VARCHAR(100) NOT NULL,
    `owner_name` VARCHAR(100) NOT NULL,
    `pet_type` VARCHAR(50) NOT NULL,
    `appointment_date` DATE NOT NULL,
    `appointment_time` TIME NOT NULL,
    `reason` TEXT NULL,
    `status` VARCHAR(20) DEFAULT 'Pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
mysqli_query($conn, $table_setup);

$appointment_query = "SELECT * FROM `appointments` ORDER BY id DESC";
$appointments_result = mysqli_query($conn, $appointment_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetSphere | Vet Consults</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="vet-consult.css">
    <style>
        .appointment-data-row input[type="text"], 
        .appointment-data-row select,
        .form-data-row input[type="text"],
        .form-data-row select {
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: inherit;
            color: inherit;
            width: 100%;
            outline: none;
        }
        .appointment-data-row select, .form-data-row select {
            cursor: pointer;
        }
        .appointment-data-row button, .form-data-row button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .date-time-cell {
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-size: 13px;
            color: #334155;
        }
        .date-time-cell div {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .time-span {
            color: #64748b;
            font-weight: 500;
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
        
        <div class="header">
            <div class="header-text">
                <h1>Vet Consultations</h1>
                <p>Manage available doctors, specializations, and scheduling</p>
            </div>
            <a href="add.appointment.php" class="btn-add">
                <i class="fas fa-plus"></i> Add New Doctor
            </a>
        </div>

        <!-- --- DOCTOR MANAGEMENT SECTION --- -->
        <section class="table-card">
    <div class="form-header-row">
        <div>Doctor ID</div>
        <div>Doctor Name</div>
        <div>Specialization</div>
        <div>Consultation Fee</div>
        <div>Status</div>
        <div style="text-align: right; padding-right: 12px;">Action</div>
    </div>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
    ?>
            <form action="update-appointment.php" method="POST" class="form-data-row">
                <div class="row-id">
                    <input type="text" name="doc_id" value="<?php echo $row['doc_id']; ?>" readonly>
                </div>
                <div class="row-name">
                    <input type="text" name="doc_name" value="<?php echo $row['doc_name']; ?>" style="border: none; background: transparent; font-weight: 700; color: #1e3a8a; outline: none; width: 100%;">
                </div>
                <div>
                    <select name="doc_spec" style="border: none; background: transparent; outline: none; width: 100%; cursor: pointer;">
                        <option value="Surgery" <?php if($row['doc_spec'] == 'Surgery') echo 'selected'; ?>>Surgery</option>
                        <option value="General Physician" <?php if($row['doc_spec'] == 'General Physician') echo 'selected'; ?>>General Physician</option>
                        <option value="Vaccination" <?php if($row['doc_spec'] == 'Vaccination') echo 'selected'; ?>>Vaccination</option>
                    </select>
                </div>
                <div>
                    <input type="text" name="doc_fee" value="<?php echo $row['doc_fee']; ?>" style="border: none; background: transparent; outline: none; width: 100%;">
                </div>
                <div>
                    <span class="badge" style="background: #dcfce7; color: #166534; padding: 6px 16px; border-radius: 20px; font-size: 12px; font-weight: 500; display: inline-block;">
                        <?php echo $row['doc_status']; ?>
                    </span>
                    <input type="hidden" name="doc_status" value="<?php echo $row['doc_status']; ?>">
                </div>
                <div class="actions-cell" style="display: flex; gap: 14px; justify-content: flex-end; align-items: center;">
                    <button type="submit" name="update_doctor" style="background: none; border: none; cursor: pointer; padding: 0; display: inline-flex; align-items: center;">
                        <i class="fas fa-edit edit-icon" title="Save Changes" style="font-size: 15px; color: #3b82f6; transition: 0.2s;"></i>
                    </button>
                    <i class="fas fa-trash delete-icon" onclick="ajaxDeleteRow(this, '<?php echo $row['doc_id']; ?>')" style="font-size: 15px; color: #ef4444; cursor: pointer; transition: 0.2s;"></i>
                </div>
            </form>
    <?php
        }
    } else {
        echo "<p class='no-records'>No doctors found in schedules. Click 'Add New Doctor' to insert data.</p>";
    }
    ?>
</section>


        <!-- --- LIVE PATIENT APPOINTMENTS SECTION --- -->
        <div class="header mt-50">
            <div class="header-text">
                <h1>Live Patient Appointments</h1>
                <p>Track real-time slots booked by owners through the client portal</p>
            </div>
        </div>

        <section class="table-card">
            <div class="appointment-header-row">
                <div>ID</div>
                <div>Doctor Allocated</div>
                <div>Owner Name</div>
                <div>Pet Breed</div>
                <div>Date & Scheduled Time</div>
                <div>Status</div>
                <div style="text-align: right; padding-right: 12px;">Action</div>
            </div>

            <?php
            if (mysqli_num_rows($appointments_result) > 0) {
                while($app_row = mysqli_fetch_assoc($appointments_result)) {
                    $current_status = (isset($app_row['status']) && !empty($app_row['status'])) ? $app_row['status'] : 'Pending';
                    
                    $status_class = 'status-pending';
                    if ($current_status == 'Approved') { $status_class = 'status-approved'; }
                    elseif ($current_status == 'Completed') { $status_class = 'status-completed'; }
            ?>
                    <form action="vet-consults.php" method="POST" class="appointment-data-row">
                        <input type="hidden" name="app_id" value="<?php echo $app_row['id']; ?>">
                        
                        <div class="app-id">#<?php echo $app_row['id']; ?></div>
                        
                        <div class="doc-allocated">
                            <i class="fas fa-user-md" style="color: #64748b; margin-right: 4px;"></i> 
                            <input type="text" name="doctor_name" value="<?php echo $app_row['doctor_name']; ?>" style="width: 85%; display: inline-block;">
                        </div>
                        
                        <div class="owner-name">
                            <input type="text" name="owner_name" value="<?php echo $app_row['owner_name']; ?>">
                        </div>
                        
                        <div>
                            <select name="pet_type">
                                <option value="Cat" <?php if($app_row['pet_type'] == 'Cat') echo 'selected'; ?>>Cat 🐱</option>
                                <option value="Parrot" <?php if($app_row['pet_type'] == 'Parrot') echo 'selected'; ?>>Parrot 🦜</option>
                                <option value="Pigeon" <?php if($app_row['pet_type'] == 'Pigeon') echo 'selected'; ?>>Pigeon 🕊️</option>
                                <option value="Other" <?php if($app_row['pet_type'] == 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="date-time-cell">
                            <div><i class="far fa-calendar-alt" style="color: #ff4b5c;"></i> <?php echo date('d-M-Y', strtotime($app_row['appointment_date'])); ?></div>
                            <div class="time-span"><i class="far fa-clock" style="color: #3b82f6;"></i> <?php echo date('h:i A', strtotime($app_row['appointment_time'])); ?></div>
                        </div>
                        
                        <div>
                            <select name="app_status" class="status-select <?php echo $status_class; ?>" onchange="changeStatusColor(this)">
                                <option value="Pending" <?php if($current_status == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Approved" <?php if($current_status == 'Approved') echo 'selected'; ?>>Approved</option>
                                <option value="Completed" <?php if($current_status == 'Completed') echo 'selected'; ?>>Completed</option>
                            </select>
                        </div>
                        
                        <div class="actions-cell">
                            <button type="submit" name="update_patient_appointment">
                                <i class="fas fa-edit edit-icon" title="Update Appointment" style="font-size: 15px;"></i>
                            </button>
                            <i class="fas fa-trash delete-icon" onclick="ajaxDeleteAppointment(this, '<?php echo $app_row['id']; ?>')" style="font-size: 15px;"></i>
                        </div>
                    </form>
            <?php
                }
            } else {
                echo "<p class='no-records-large'>No active patient appointments logged yet.</p>";
            }
            
            mysqli_close($conn);
            ?>
        </section>
    </main>

<script>
    function changeStatusColor(selectElement) {
        selectElement.classList.remove('status-pending', 'status-approved', 'status-completed');
        if (selectElement.value === 'Pending') {
            selectElement.classList.add('status-pending');
        } else if (selectElement.value === 'Approved') {
            selectElement.classList.add('status-approved');
        } else if (selectElement.value === 'Completed') {
            selectElement.classList.add('status-completed');
        }
    }

    function ajaxDeleteRow(element, id) {
        if (confirm("Are you sure you want to delete this doctor?")) {
            fetch('delete-appointment.php?id=' + encodeURIComponent(id), { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                if(data.trim() === "Success") {
                    let row = element.closest('.form-data-row');
                    if (row) row.remove();
                } else {
                    alert("Database se delete nahi ho saka: " + data);
                }
            })
            .catch(error => { console.error('Error:', error); });
        }
    }

    function ajaxDeleteAppointment(element, id) {
        if (confirm("Are you sure you want to delete this appointment?")) {
            fetch('delete-patient-appointment.php?id=' + encodeURIComponent(id), { method: 'GET' })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === "Success") {
                    let row = element.closest('.appointment-data-row');
                    if (row) row.remove();
                    window.location.reload();
                } else {
                    alert("Database se delete nahi ho saka: " + data);
                }
            })
            .catch(error => { 
                console.error('Error:', error); 
                alert("File contact nahi ho saki. Please check file name.");
            });
        }
    }
</script>
</body>
</html>