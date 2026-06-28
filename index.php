<?php
// ==========================================
// 1. DATABASE CONNECTION & CONFIGURATION
// ==========================================
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet_sphere";

$conn = new mysqli($servername, $username, $password, $dbname);

// Connection test karna
if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

// ==========================================
// 2. AUTOMATIC TABLE CREATION (IF NOT EXISTS)
// ==========================================
$table_setup = "CREATE TABLE IF NOT EXISTS `contact_queries` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `subject` VARCHAR(255) NULL,
    `message` TEXT NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($table_setup);

// ==========================================
// 3. CONTACT FORM PROCESSOR
// ==========================================
$alert_notification = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_contact_btn'])) {
    // Input parameters ko secure banana SQL Injection se bachane ke liye
    $name = mysqli_real_escape_string($conn, trim($_POST['name']));
    $email = mysqli_real_escape_string($conn, trim($_POST['email']));
    $subject = mysqli_real_escape_string($conn, trim($_POST['subject']));
    $message = mysqli_real_escape_string($conn, trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        $insert_sql = "INSERT INTO `contact_queries` (`name`, `email`, `subject`, `message`) VALUES ('$name', '$email', '$subject', '$message')";
        
        if ($conn->query($insert_sql) === TRUE) {
            $alert_notification = "<div class='success-alert'><i class='fas fa-check-circle'></i> Thank you! Your message has been sent successfully.</div>";
        } else {
            $alert_notification = "<div class='error-alert'><i class='fas fa-exclamation-triangle'></i> Database Error: " . $conn->error . "</div>";
        }
    } else {
        $alert_notification = "<div class='error-alert'><i class='fas fa-exclamation-circle'></i> Please fill out all required fields.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <title>Pet Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   
    <style>
        /* ===== GOOGLE FONT ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Poppins:wght@600&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    background:#ffffff;
}

/* ================= NAVBAR ================= */

header{
    position:fixed;
    width:100%;
    top:0;
    left:0;
    background:#ffffff;
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:18px 100px;
    z-index:1000;
}

.logo{
    display:flex;
    align-items:center;
    font-size:22px;
    font-weight:700;
    color:#1e1e1e;
}

.logo i{
    color:#ff7b00;
    margin-right:8px;
    font-size:24px;
}

nav a{
    margin:0 15px;
    text-decoration:none;
    color:#333;
    font-weight:500;
    transition:0.3s;
}

nav a:hover{
    color:#ff7b00;
}

.auth-buttons {
    display: flex;
    gap: 10px;
}

.btn {
    text-decoration: none;
    padding: 8px 18px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: bold;
    transition: 0.3s ease;
}

/* Login Button */
.login-btn {
    background-color: black;
    border: 2px solid orange;
    color: white;
}

.login-btn:hover {
    background-color: transparent;
    color: black;
}

/* Signup Button */
.signup-btn {
    background-color: black;
    color: white;
    border: 2px solid orange;
}

.signup-btn:hover {
    background-color: transparent;
    color: black;
}

         
/* ================= HERO SECTION ================= */

.hero{
    height:100vh;
    background: url('images/background image.jpeg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    display:flex;
    align-items:center;
    padding:0 100px;
    position:relative;
}

.hero-content{
    color:#fff;
    max-width:600px;
}

.hero-content h2{
    font-size:40px;
    font-weight:600;
}

.hero-content h2 span{
    color:#ff7b00;
}

.hero-content h1{
    font-size:60px;
    font-weight:800;
    margin:10px 0 30px;
}

.btn{
    display:inline-block;
    padding:12px 30px;
    border:2px solid #fff;
    color:#fff;
    text-decoration:none;
    border-radius:30px;
    transition:0.3s;
}

.btn:hover{
    background:#ff7b00;
    border-color:#ff7b00;
}

/* ================= WAVE SHAPE ================= */

.wave{
    position:absolute;
    bottom:0;
    left:0;
    width:100%;
    height:120px;
    background:#fff;
    border-top-left-radius:50% 100%;
    border-top-right-radius:50% 100%;
}
html{
    scroll-behavior: smooth;
}

/* TOP BANNERS */
.services-banner {
    display: flex;
    justify-content: center;
    gap: 25px;
    padding: 50px 60px;
    background: #f8f9fb;
}

.banner-card {
    width: 30%;
    height: 220px;
    border-radius: 15px;
    background-size: cover;
    background-position: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}
.banner-card .overlay {
    position: absolute;
    bottom: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
    color: white;
    padding: 20px;
}

.banner-card h2 {
    margin-bottom: 8px;
}

/* Background Images */
.buy { background-image: url('images/buy-sell-pets.jpeg'); }
.doctor { background-image: url('images/Professional-veterinary-care.jpeg'); }
.medical { background-image: url('images/pet-medical-store.jpeg'); }

/* ABOUT SECTION */
.about-section {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 60px;
    gap: 60px;
    background: white;
}

.about-image img {
    width: 420px;
}

.about-content {
    max-width: 500px;
}

.about-content h1 {
    font-size: 32px;
    margin-bottom: 20px;
    color: #2c3e50;
}

.about-content p {
    color: #555;
    margin-bottom: 20px;
    line-height: 1.6;
}

.features {
    margin-bottom: 20px;
}

.features div {
    margin-bottom: 10px;
    font-weight: 500;
    color: #e67e22;
}

.extra-text {
    font-size: 14px;
    color: #666;
}

/* TEAM SECTION */
.team-section{
    text-align:center;
    padding:60px 20px;
    background:#f4f4f4;
}

.team-section h4{
    color:#ff7a59;
    margin-bottom:10px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.team-section h2{
    font-size:40px;
    margin-bottom:50px;
}

.team-section h2 span{
    color:#ff7a59;
}

.team-container{
    display:flex;
    justify-content:center;
    gap:30px;
    flex-wrap:wrap;
}

.card{
    background:#fff;
    width:300px;
    border-radius:15px;
    overflow:hidden;
    position:relative;
    transition:0.4s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow:0 8px 25px rgba(0,0,0,0.05);
    border: 1px solid #eeebe7;
    display: flex;
    flex-direction: column;
}

.card:hover{
    transform:translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
}

.img-box {
    width: 100%;
    height: 260px;
    overflow: hidden;
}

.img-box img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition: 0.5s;
}

.card:hover .img-box img {
    transform: scale(1.05);
}

.content{
    padding:25px 20px;
    text-align: center;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.content h3{
    margin-bottom:6px;
    font-size: 1.25rem;
    color: #1a1817;
    font-weight: 600;
}

.content p{
    color:#857e78;
    font-size: 0.95rem;
    margin-bottom: 18px;
}

.view-profile-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: transparent;
    color: #ff7a59;
    border: 2px solid #ff7a59;
    text-decoration: none;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    transition: 0.3s ease;
}

.view-profile-btn:hover {
    background-color: #ff7a59;
    color: white;
}

.social{
    position:absolute;
    bottom:-60px;
    left:0;
    width:100%;
    background:#222;
    padding:15px 0;
    transition:0.4s;
    text-align: center;
}

.card:hover .social{
    bottom:0;
}

.social i{
    color:#ff7a59;
    margin:0 10px;
    cursor:pointer;
    transition:0.3s;
}

.social i:hover{
    color:#fff;
}

/* Contact Section */
.contact{
    padding:60px 10%;
    background:white;
    text-align:center;
}

.contact h1{
    font-size:36px;
    margin-bottom:30px;
}

.contact h1 span{
    color:orange;
}

.contact-form{
    max-width:700px;
    margin:auto;
}

.contact-form input,
.contact-form textarea{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ccc;
    border-radius:5px;
}

.contact-form textarea{
    height:150px;
    resize:none;
}

.contact-form button{
    background:orange;
    color:white;
    border:none;
    padding:12px 25px;
    font-size:16px;
    cursor:pointer;
    border-radius:5px;
}

.contact-form button:hover{
    background:#e67e22;
}

/* Status Notifications Alert Styles */
.success-alert {
    background-color: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-size: 15px;
    font-weight: 500;
    border: 1px solid #c3e6cb;
    text-align: left;
}
.error-alert {
    background-color: #f8d7da;
    color: #721c24;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    font-size: 15px;
    font-weight: 500;
    border: 1px solid #f5c6cb;
    text-align: left;
}

/* Map */
.map{
    margin-top:40px;
}

.map iframe{
    width:100%;
    height:350px;
    border:none;
}

/* Footer */
footer{
    background:#111;
    color:white;
    padding:40px 10%;
    display:flex;
    flex-wrap:wrap;
    justify-content:space-between;
}

.footer-box{
    width:220px;
    margin-bottom:20px;
}

.footer-box h2{
    color:orange;
    margin-bottom:10px;
}

.footer-box ul{
    list-style:none;
}

.footer-box ul li{
    margin:6px 0;
}

.newsletter input{
    width:100%;
    padding:8px;
    margin:6px 0;
    border:none;
}

.newsletter button{
    background:orange;
    color:white;
    border:none;
    padding:8px;
    cursor:pointer;
}

.copy{
    background:#000;
    color:white;
    text-align:center;
    padding:10px;
}

.main-title {
  font-size: 2.8rem;
  font-weight: 700;
  color: #1a1817;
  letter-spacing: -1px;
  margin-bottom: 12px;
}

.subtitle {
  font-size: 1.1rem;
  color: #857e78;
  font-weight: 400;
}

/* --- Responsive Main Layout --- */
.main-layout {
  max-width: 1200px;
  margin: 0 auto;
  background: #ffffff;
  padding-bottom: 40px;
}

.category-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 40px;
  padding: 10px;
}

/* --- Premium Category Cards (3 Boxes) --- */
.category-card {
  background: #ffffff;
  border: 1px solid #eeebe7;
  border-radius: 24px;
  overflow: hidden;
  text-decoration: none; 
  color: inherit;
  display: flex;
  flex-direction: column;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
  transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  animation: fadeInUp 0.8s ease-out;
}

.category-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(74, 69, 64, 0.08);
  border-color: #dcd7d0;
}

.img-container {
  position: relative;
  height: 240px;
  overflow: hidden;
}

.category-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

.category-card:hover img {
  transform: scale(1.08);
}

.category-card .overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, transparent 60%, rgba(0,0,0,0.05));
}

.card-info {
  padding: 25px;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.card-info h3 {
  font-size: 1.5rem;
  font-weight: 700;
  color: #1a1817;
}

.card-info p {
  font-size: 0.95rem;
  color: #857e78;
}

.explore-btn {
  margin-top: 10px;
  font-size: 0.9rem;
  font-weight: 600;
  color: #8a7355; 
  transition: color 0.3s ease;
}

.category-card:hover .explore-btn {
  color: #5c4b35;
}

@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
  .main-title { font-size: 2.2rem; }
  .category-grid { gap: 25px; }
}

/* Main Wrapper Styling */
.shop-header-container {
    text-align: center;
    width: 100%;
    padding: 40px 20px 10px 20px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #ffffff;
    background-color:white;
}

.shop-badge-wrapper {
    margin-bottom: 8px;
}

.shop-tag {
    background-color: #fff0f3; 
    color: #ff4d6d; 
    font-size: 9.5pt;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 50px;
    display: inline-block;
    letter-spacing: 1px;
    text-transform: uppercase;
}

.shop-main-title {
    font-family: 'Fredoka', sans-serif; 
    font-size: 28pt;
    color: #1e293b; 
    margin: 0;
    font-weight: 600;
    letter-spacing: -0.5px;
}

.shop-subtitle {
    color: #64748b; 
    font-size: 11pt;
    margin: 6px 0 0 0;
}

.shop-fancy-divider {
    display: block;
    width: 180px;
    height: 1.5px;
    background: linear-gradient(90deg, transparent, #ff4d6d, transparent);
    margin: 16px auto 0 auto;
    position: relative;
}

.shop-divider-paw {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #f8f9fb; 
    padding: 0 12px;
    font-size: 11pt;
    color: #ff4d6d;
}

/* ================= MEDICINE BANNER STYLES ================= */
.medicine-section-wrapper {
    background-color: white; 
    padding: 60px 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.composite-banner-canvas {
    position: relative;
    width: 100%;
    max-width: 950px;
    height: 540px;
    background-color: #ffffff;
    border-radius: 28px;
    overflow: hidden;
    display: flex;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
}

.hand-drawn-border-layer {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 1;
    background-repeat: no-repeat;
    background-size: 100% 100%;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 950 540' fill='none' stroke='%234a628a' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'><path d='M20 20 h60 v70 h-60 z M30 35 h40 M30 50 h40 M30 65 h40' stroke='%23d9534f'/><circle cx='120' cy='40' r='10' fill='%23d9534f'/><circle cx='150' cy='40' r='10'/><path d='M220 20 l40 40 M230 15 l40 40'/><path d='M20 150 c10 20 20 50 15 90 l-15 40' stroke-width='2'/><path d='M35 180 h30' stroke='%23d9534f' stroke-width='3'/><path d='M15 420 h60 v100 h-60 z'/><path d='M30 450 l30 30' stroke='%23d9534f'/><path d='M420 510 h100 v20 h-100 z'/><circle cx='440' cy='520' r='6' fill='%23d9534f'/><circle cx='470' cy='520' r='6'/></svg>");
}

.left-typography-node {
    position: absolute;
    top: 38%;
    left: 15%;
    z-index: 10;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.left-typography-node h1 {
    font-family: 'Playfair Display', serif;
    font-size: 54px;
    color: #3b4e70; 
    font-weight: 600;
    letter-spacing: -0.5px;
    line-height: 1;
}

.pill-capsule-btn {
    display: inline-flex;
    align-items: center;
    align-self: flex-start;
    background-color: #ffffff;
    color: #55627a;
    text-decoration: none;
    padding: 10px 24px;
    border-radius: 50px;
    font-family: Arial, sans-serif;
    font-weight: bold;
    font-size: 13px;
    letter-spacing: 1.5px;
    border: 1px solid #e5ebf1;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
    cursor: pointer;
    transition: all 0.2s ease;
}

.pill-capsule-btn span {
    margin-right: 14px;
}

.pill-capsule-btn .arrow-bubble {
    background-color: #55627a;
    color: #ffffff;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 11px;
    transition: transform 0.2s ease;
}

.pill-capsule-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(85, 98, 122, 0.12);
    background-color: #fafbfc;
}

.pill-capsule-btn:hover .arrow-bubble {
    transform: translateX(3px);
}

.shield-identity-badge {
    position: absolute;
    bottom: 40px;
    left: 14%;
    z-index: 10;
    width: 140px;
    height: 100px;
    background-color: #55627a;
    border-radius: 40% 40% 50% 50% / 30% 30% 70% 70%; 
    display: flex;
    justify-content: center;
    align-items: center;
    padding-bottom: 5px;
}

.shield-identity-badge svg {
    width: 75px;
    fill: #ffffff;
}

.right-mask-container {
    position: absolute;
    top: 15%;
    right: 8%;
    width: 480px;
    height: 480px;
    z-index: 5;
}

.crescent-outer-rim {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: #55627a;
    opacity: 0.15;
    transform: scale(1.04);
    pointer-events: none;
}

.circular-photo-window {
    position: absolute;
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 12px solid #ffffff;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    background-image: url("https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?q=80&w=1000"); 
    background-size: cover;
    background-position: center;
}

.upper-right-graphics-patch {
    position: absolute;
    top: -20px;
    right: -20px;
    width: 320px;
    height: 240px;
    z-index: 15;
    pointer-events: none;
    background-repeat: no-repeat;
    background-size: contain;
    background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 240' fill='none' stroke='%234a628a' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'><path d='M220 50 c-20-10-60-5-90 20 s-40 60-30 80' stroke-width='2'/><path d='M180 30 h40 v40 h-40 z' fill='%23ffffff' stroke-width='2'/><path d='M190 50 h20 M200 40 v20' stroke='%23d9534f' stroke-width='3'/><path d='M130 60 l-50-40 M125 55 l-50-40' stroke-width='1.2'/><path d='M250 80 l40 60 M260 75 l40 60' stroke-width='1.5'/></svg>");
}

@media (max-width: 900px) {
    .composite-banner-canvas {
        height: 440px;
        max-width: 480px;
        flex-direction: column;
    }
    .left-typography-node {
        top: 30%;
        left: 10%;
    }
    .left-typography-node h1 { font-size: 38px; }
    .right-mask-container {
        width: 280px;
        height: 280px;
        bottom: 20px;
        top: auto;
        right: 10px;
    }
    .shield-identity-badge {
        display: none; 
    }
    .hand-drawn-border-layer { opacity: 0.3; }
}
    </style>
</head>
<body>

    <header>
        <div class="logo">
            <i class="fa-solid fa-paw"></i>
            <span>PET SPHERE</span>
        </div>

        <nav>
            <a href="firstpage.php">Home</a>
            <a href="#about">About</a>
            <a href="#shop">Shop</a>
            <a href="#Services">Services</a>
            <a href="#Medicines">Medicines</a>
            <a href="#Contact">Contact</a>
        </nav>
        <div class="auth-buttons">
            <a href="login.php" class="btn login-btn">Login</a>
            <a href="signup.php" class="btn signup-btn">Sign Up</a>
            </div>
    </header>
    

    <section class="hero">
        <div class="hero-content">
            <h2><span>Hi</span> Welcome To</h2>
            <h1>Our Pet Shop</h1>
            <a href="#shop" class="btn">Shop Now</a>
        </div>
        <div class="wave"></div>
    </section>


    <section class="services-banner">
        <div class="banner-card buy">
            <div class="overlay">
                <h2>Buy & Sell Pets</h2>
                <p>Find your perfect companion or connect your pets with loving families.</p>
            </div>
        </div>

        <div class="banner-card doctor">
            <div class="overlay">
                <h2>Professional Veterinary Care</h2>
                <p>Certified doctors providing complete health checkups and emergency care.</p>
            </div>
        </div>

        <div class="banner-card medical">
            <div class="overlay">
                <h2>Pet Medical Store</h2>
                <p>Authentic medicines and prescriptions for your pet’s healthy life.</p>
            </div>
        </div>
    </section>


    <section class="about-section" id="about">
        <div class="about-image">
            <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b" alt="Pets">
        </div>

        <div class="about-content">
            <h1>Your Trusted Pet Partner</h1>
            <p>
                Pet Sphere is a complete pet care web application designed to make pet ownership easier and more reliable.
                We offer a secure platform for buying and selling pets, professional veterinary consultation,
                and a trusted online medical store — all in one place.
            </p>

            <div class="features">
                <div>✔ Verified Pet Listings</div>
                <div>✔ Certified Veterinary Doctors</div>
                <div>✔ Online Medical Store</div>
                <div>✔ Safe & Easy Adoption Process</div>
            </div>

            <p class="extra-text">
                At Pet Sphere, we believe every pet deserves love, care, and proper medical attention.
                Our mission is to connect pet lovers with trusted services while ensuring safety,
                transparency, and quality care for every companion.
            </p>
        </div>
    </section>


    <div class="shop-header-container">
        <div class="shop-badge-wrapper">
            <span class="shop-tag">Our Collection</span>
        </div>
        <h2 class="shop-main-title">Shop Now</h2>
        <p class="shop-subtitle">Find your perfect little companion from our premium categories</p>
        <div class="shop-fancy-divider">
            <span class="shop-divider-paw">🐾</span>
        </div>
    </div>


    <main class="main-layout">
        <section class="category-grid" id="shop">
            <a href="cats.php" class="category-card">
                <div class="img-container">
                    <img src="images/cat.jpeg" alt="Cats Collection">
                    <div class="overlay"></div>
                </div>
                <div class="card-info">
                    <h3>Cats</h3>
                    <p>Explore Elegant Breeds</p>
                    <span class="explore-btn">View Collection &rarr;</span>
                </div>
            </a>

            <a href="parrot.php" class="category-card">
                <div class="img-container">
                    <img src="images/parrot.jpeg" alt="Parrots Collection">
                    <div class="overlay"></div>
                </div>
                <div class="card-info">
                    <h3>Parrots</h3>
                    <p>Exotic & Intelligent Birds</p>
                    <span class="explore-btn">View Collection &rarr;</span>
                </div>
            </a>

            <a href="pigeon.php" class="category-card">
                <div class="img-container">
                    <img src="images/pigeon.jpeg" alt="Pigeons Collection">
                    <div class="overlay"></div>
                </div>
                <div class="card-info">
                    <h3>Pigeons</h3>
                    <p>Rare & Beautiful Flyers</p>
                    <span class="explore-btn">View Collection &rarr;</span>
                </div>
            </a>
        </section>
    </main>

    <section class="team-section" id="Services">
        <h4>Our Experts</h4>
        <h2>Meet Our <span>Doctors</span></h2>

        <div class="team-container">
            <!-- Doctor 1 -->
            <div class="card">
                <div class="img-box">
                    <img src="images/doctor-faisal.jpeg" alt="Dr. Muhammad Faisal">
                </div>
                <div class="content">
                    <h3>Dr. Muhammad Faisal</h3>
                    <p>Doctor Pets Clinic</p>
                    <a href="doctor-details.php?id=1" class="view-profile-btn">View Details</a>
                </div>
            </div>

            <!-- Doctor 2 -->
            <div class="card">
                <div class="img-box">
                    <img src="images/doctor-umair.jpeg" alt="Dr. Umair">
                </div>
                <div class="content">
                    <h3>Dr. Umair</h3>
                    <p>Umair Pets Clinic</p>
                    <a href="doctor-details.php?id=2" class="view-profile-btn">View Details</a>
                </div>
            </div>

            <!-- Doctor 3 -->
            <div class="card">
                <div class="img-box">
                    <img src="images/doctor-khawaja.jpeg" alt="Dr. Khawaja M. Ibrahim">
                </div>
                <div class="content">
                    <h3>Dr. Khawaja M. Ibrahim</h3>
                    <p>Ibrahim Pet Clinic</p>
                    <a href="doctor-details.php?id=3" class="view-profile-btn">View Details</a>
                </div>
            </div>
        </div>
    </section>

    <section class="medicine-section-wrapper" id="Medicines">
        <div class="composite-banner-canvas">
            
            <div class="hand-drawn-border-layer"></div>

            <div class="left-typography-node">
                <h1>Pharmacy</h1>
                <a href="pharmacy-1stpage.php" class="pill-capsule-btn" id="ctaActionTrigger">
                    <span>SHOP NOW</span>
                    <div class="arrow-bubble">&#10095;</div>
                </a>
            </div>

            <div class="shield-identity-badge">
                <svg viewBox="0 0 100 40" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20,32 C22,32 23,29 24,25 C25,21 23,16 26,13 C27,12 29,13 30,12 C31,10 30,7 32,6 C33,5 35,7 35,8 C37,7 39,11 38,13 C37,15 39,17 41,18 C43,19 45,17 47,20 C48,22 46,26 47,29 C48,32 52,33 54,34 L20,34 Z" />
                    <path d="M56,34 C57,30 59,26 62,23 C64,21 67,23 69,19 C70,17 68,13 71,12 C73,11 75,14 74,16 C76,18 78,23 76,26 C77,29 81,32 83,34 L56,34 Z" />
                    <rect x="12" y="34" width="76" height="1.5" />
                </svg>
            </div>

            <div class="right-mask-container">
                <div class="crescent-outer-rim"></div>
                <div class="circular-photo-window"></div>
            </div>

            <div class="upper-right-graphics-patch"></div>

        </div>
    </section>


    <section class="contact" id="Contact">
        <h1>Contact For <span>Any Query</span></h1>
        <div class="contact-form">
            
            <?php if (!empty($alert_notification)) { echo $alert_notification; } ?>

            <form action="#Contact" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject">
                <textarea name="message" placeholder="Message" required></textarea>
                <button type="submit" name="submit_contact_btn">Send Message</button>
            </form>
        </div>
    </section>


    <footer>
        <div class="footer-box">
            <h2>Pet Sphere</h2>
            <ul>
                <li>About Us</li>
                <li>Our Services</li>
                <li>Privacy Policy</li>
            </ul>
        </div>
        <div class="footer-box">
            <h2>Quick Links</h2>
            <ul>
                <li>Shop</li>
                <li>Medicines</li>
                <li>Contact</li>
            </ul>
        </div>
        <div class="footer-box newsletter">
            <h2>Newsletter</h2>
            <input type="email" placeholder="Your Email">
            <button>Subscribe</button>
        </div>
    </footer>
    <div class="copy">
        <p>&copy; 2026 Pet Sphere. All Rights Reserved.</p>
    </div>

</body>
</html>