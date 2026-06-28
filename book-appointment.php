<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_sphere";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// Table verification
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
$conn->query($table_setup);

// Doctors contact numbers
$doctors_list = [
    1 => ["name" => "Dr. Muhammad Faisal", "phone" => "923164571277"],
    2 => ["name" => "Dr. Umair", "phone" => "923314452039"],
    3 => ["name" => "Dr. Khawaja M. Ibrahim", "phone" => "923416073420"]
];

$doctor_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$selected_doctor = isset($doctors_list[$doctor_id]) ? $doctors_list[$doctor_id]['name'] : $doctors_list[1]['name'];

$alert_message = "";
$whatsapp_url = "";
$send_wp = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_booking'])) {
    $doc_name = mysqli_real_escape_string($conn, $_POST['doctor_name']);
    $owner_name = mysqli_real_escape_string($conn, trim($_POST['owner_name']));
    $pet_type = mysqli_real_escape_string($conn, $_POST['pet_type']);
    $app_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $app_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
    $reason = mysqli_real_escape_string($conn, trim($_POST['reason']));

    if (!empty($owner_name) && !empty($app_date) && !empty($app_time)) {
       $sql = "INSERT INTO `appointments` (`doctor_name`, `owner_name`, `pet_type`, `appointment_date`, `appointment_time`, `reason`) 
        VALUES ('$doc_name', '$owner_name', '$pet_type', '$app_date', '$app_time', '$reason')";
        if ($conn->query($sql) === TRUE) {
            // Find target phone number
            $target_phone = "923338774045"; 
            foreach($doctors_list as $doc) {
                if($doc['name'] == $doc_name) {
                    $target_phone = $doc['phone'];
                    break;
                }
            }
            
            $formatted_date = date("d-M-Y", strtotime($app_date));
            $formatted_time = date("h:i A", strtotime($app_time));
            
            // Text formatting for WhatsApp message
            $message_text = "🚨 *NEW APPOINTMENT - PET SPHERE* 🚨\n\n"
                          . "Dear *$doc_name*,\n"
                          . "A new appointment has been logged on the portal.\n\n"
                          . "👤 *Owner:* $owner_name\n"
                          . "🐾 *Pet:* $pet_type\n"
                          . "📅 *Date:* $formatted_date\n"
                          . "⏰ *Time:* $formatted_time\n"
                          . "📝 *Reason:* $reason\n\n"
                          . "Kindly check your panel to confirm.";
            
            // WhatsApp API Link
            $whatsapp_url = "https://api.whatsapp.com/send?phone=" . $target_phone . "&text=" . urlencode($message_text);
            $send_wp = true;

            $alert_message = "<div class='success-alert'><i class='fas fa-check-circle'></i> Appointment Saved! Redirecting to WhatsApp to notify the doctor...</div>";
        } else {
            $alert_message = "<div class='error-alert'>Database Error: " . $conn->error . "</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment - Pet Sphere</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Fredoka:wght@500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f8f9fb;
            color: #333;
            padding-top: 120px;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            background: #ffffff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 100px;
            z-index: 1000;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 22px;
            font-weight: 700;
            color: #1e1e1e;
        }

        .logo i {
            color: #ff7b00;
            margin-right: 8px;
            font-size: 24px;
        }

        .back-home-btn {
            text-decoration: none;
            padding: 10px 22px;
            background-color: white;
            color: black;
            border: 2px solid orange;
            border-radius: 30px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .back-home-btn:hover {
            background-color: orange;
            color: white;
        }

        .form-wrapper {
            max-width: 650px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.05);
            border: 1px solid #eeebe7;
            padding: 40px;
        }

        .badge-tag {
            background-color: #fff0f3; 
            color: #ff4d6d; 
            font-size: 9pt;
            font-weight: 700;
            padding: 5px 14px;
            border-radius: 50px;
            display: inline-block;
            text-transform: uppercase;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .form-title {
            font-family: 'Fredoka', sans-serif;
            font-size: 24pt;
            color: #1e293b;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.95rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-size: 1rem;
            color: #334155;
            background-color: #fff;
            transition: 0.3s;
        }

        .form-control:focus {
            border-color: #ff7b00;
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 123, 0, 0.1);
        }

        textarea.form-control {
            height: 100px;
            resize: none;
        }

        .submit-btn {
            width: 100%;
            background-color: white;
            color: black;
            border: 2px solid orange;
            padding: 14px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #ff7b00;
            border-color: #ff7b00;
            box-shadow: 0 5px 15px rgba(255, 123, 0, 0.2);
            color:white;
        }

        .success-alert {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #c3e6cb;
        }

        .error-alert {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
    </style>
    <?php if ($send_wp && !empty($whatsapp_url)): ?>
<script type="text/javascript">
    // 1.5 seconds ka delay taaki user ko pehle success message dikhe, phir redirection ho
    setTimeout(function() {
        window.location.href = "<?php echo $whatsapp_url; ?>";
    }, 1500);
</script>
<?php endif; ?>
</head>
<body>

    <header>
        <div class="logo">
            <i class="fa-solid fa-paw"></i>
            <span>PET SPHERE</span>
        </div>
        <a href="firstpage.php#Services" class="back-home-btn">&larr; Back to Home</a>
    </header>

    <div class="form-wrapper">
        <span class="badge-tag">WhatsApp Instant Alert</span>
        <h1 class="form-title">Book An Appointment</h1>

        <?php if (!empty($alert_message)) { echo $alert_message; } ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Selected Consultant Doctor</label>
                <select name="doctor_name" class="form-control" required>
                    <?php foreach($doctors_list as $doc): ?>
                        <option value="<?php echo $doc['name']; ?>" <?php if($doc['name'] == $selected_doctor) echo 'selected'; ?>>
                            <?php echo $doc['name']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Your Name (Pet Owner)</label>
                <input type="text" name="owner_name" class="form-control" placeholder="Enter full name" required>
            </div>

            <div class="form-group">
                <label>Select Pet Type</label>
                <select name="pet_type" class="form-control">
                    <option value="Cat">Cat 🐱</option>
                    <option value="Parrot">Parrot 🦜</option>
                    <option value="Pigeon">Pigeon 🕊️</option>
                    <option value="Other">Other Pet</option>
                </select>
            </div>

            <div style="display: flex; gap: 15px;">
                <div class="form-group" style="flex: 1;">
                    <label>Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-control" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Preferred Time Slot</label>
                    <input type="time" name="appointment_time" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label>Describe Pet Symptoms / Health Concern</label>
                <textarea name="reason" class="form-control" placeholder="Write briefly about the issues your pet is facing..."></textarea>
            </div>

            <button type="submit" name="submit_booking" class="submit-btn">
                <i class="fa-brands fa-whatsapp" style="margin-right: 8px;"></i> Confirm & Notify Doctor via WP
            </button>
        </form>
    </div>

</body>
</html>