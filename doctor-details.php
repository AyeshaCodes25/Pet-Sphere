<?php
// Doctor ID ko read karna URL parameter se
$doctor_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Doctors ka factual data
$doctors_data = [
    1 => [
        "name" => "Dr. Muhammad Faisal",
        "shop" => "Doctor Pets Clinic",
        "address" => "Aadha Stop Near Total Petrol Pump Daska Road Sialkot",
        "contact" => "923164571277",
        "insta" => "Doctor Pets Clinic Sialkot",
        "timing" => "12:00 PM to 08:00 PM",
        "image" => "images/doctor-faisal.jpeg"
    ],
    2 => [
        "name" => "Dr. Umair",
        "shop" => "Umair Pets Clinic",
        "address" => "Umair pet clinic sadar bazaar Sialkot",
        "contact" => "923314452039",
        "insta" => "umair pets clinic",
        "timing" => "01:00 AM to 09:00 PM",
        "image" => "images/doctor-umair.jpeg"
    ],
    3 => [
        "name" => "Dr. Khawaja M. Ibrahim",
        "shop" => "Ibrahim Pet Clinic",
        "address" => "Ibrahim pet clinic, Opp. Allama Iqbal Law college, Murray college road, Sialkot",
        "contact" => "923416073420",
        "insta" => "ibrahimpetclinic",
        "timing" => "Monday to Saturday 12:00 PM to 10:00 PM | Friday and Sunday: 03:00 PM to 10:00 PM",
        "image" => "images/doctor-khawaja.jpeg"
    ]
];

$doctor = isset($doctors_data[$doctor_id]) ? $doctors_data[$doctor_id] : $doctors_data[1];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $doctor['name']; ?> - Pet Sphere</title>
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

        .details-wrapper {
            max-width: 900px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.05);
            border: 1px solid #eeebe7;
            overflow: hidden;
            display: flex;
        }

        .details-image-section {
            width: 40%;
            background: #f4f4f4;
            position: relative;
        }

        .details-image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .details-content-section {
            width: 60%;
            padding: 45px;
            display: flex;
            flex-direction: column;
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
            align-self: flex-start;
        }

        .doc-title {
            font-family: 'Fredoka', sans-serif;
            font-size: 26pt;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .clinic-sub {
            font-size: 1.15rem;
            color: #ff7b00;
            font-weight: 500;
            margin-bottom: 30px;
        }

        .info-item-box {
            display: flex;
            align-items: flex-start;
            gap: 15px;
            margin-bottom: 22px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #e2e8f0;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #fdf2e9;
            color: #ff7b00;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .info-texts h4 {
            font-size: 0.9rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .info-texts p {
            font-size: 1.05rem;
            color: #334155;
            font-weight: 500;
            line-height: 1.4;
        }

        /* NEW: Classy Book Appointment Button */
        .book-appointment-btn {
            display: block;
            text-align: center;
            text-decoration: none;
            background-color: white;
            color: black;
            border: 2px solid orange;
            padding: 14px 30px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            margin-top: 25px;
            transition: 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 123, 0, 0.15);
        }

        .book-appointment-btn:hover {
            background-color: #ff7b00;
            border-color: #ff7b00;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 123, 0, 0.3);
            color: white;
        }

        @media (max-width: 768px) {
            .details-wrapper {
                flex-direction: column;
                margin: 20px;
            }
            .details-image-section {
                width: 100%;
                height: 300px;
            }
            .details-content-section {
                width: 100%;
                padding: 30px;
            }
            header {
                padding: 15px 30px;
            }
        }
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <i class="fa-solid fa-paw"></i>
            <span>PET SPHERE</span>
        </div>
        <a href="firstpage.php#Services" class="back-home-btn">&larr; Back to Services</a>
    </header>

    <div class="details-wrapper">
        <div class="details-image-section">
            <img src="<?php echo $doctor['image']; ?>" alt="<?php echo $doctor['name']; ?>">
        </div>
        
        <div class="details-content-section">
            <span class="badge-tag">Verified Specialist</span>
            <h1 class="doc-title"><?php echo $doctor['name']; ?></h1>
            <p class="clinic-sub"><?php echo $doctor['shop']; ?></p>

            <div class="info-item-box">
                <div class="icon-circle"><i class="fa-solid fa-location-dot"></i></div>
                <div class="info-texts">
                    <h4>Clinic Address</h4>
                    <p><?php echo $doctor['address']; ?></p>
                </div>
            </div>

            <div class="info-item-box">
                <div class="icon-circle"><i class="fa-solid fa-phone"></i></div>
                <div class="info-texts">
                    <h4>Contact Number</h4>
                    <p><?php echo $doctor['contact']; ?></p>
                </div>
            </div>

            <div class="info-item-box">
                <div class="icon-circle"><i class="fa-solid fa-clock"></i></div>
                <div class="info-texts">
                    <h4>Clinic Timings</h4>
                    <p><?php echo $doctor['timing']; ?></p>
                </div>
            </div>

            <?php if(!empty($doctor['insta'])): ?>
            <div class="info-item-box">
                <div class="icon-circle"><i class="fa-brands fa-instagram"></i></div>
                <div class="info-texts">
                    <h4>Instagram Handle</h4>
                    <p><?php echo $doctor['insta']; ?></p>
                </div>
            </div>
            <?php endif; ?>

            <a href="book-appointment.php?id=<?php echo $doctor_id; ?>" class="book-appointment-btn">
                <i class="fa-solid fa-calendar-check" style="margin-right: 8px;"></i> Book Appointment Now
            </a>

        </div>
    </div>

</body>
</html>