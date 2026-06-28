<?php
// 1. Session aur Connection Start Ki
session_start();
include('config.php'); 

$error_msg = "";

// 2. BACKEND LOGIN & REDIRECTION WORK
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_login'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Database se user ko dhoondne ki query
    $query = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Session Variables save karwana fyp me security ke liye zaroori h
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_role'] = $row['role']; 
        
        // 🌟 ROLE-BASED REDIRECTION (Dono dashboards ko link karne ka main logic)
        if (strtolower($row['role']) == 'admin') {
            echo "<script>
                    alert('Welcome Admin! Logging you in...');
                    window.location.href='dashboard.php'; 
                  </script>";
            exit();
        } else if (strtolower($row['role']) == 'client') {
            echo "<script>
                    alert('Login Successful! Welcome to PetSphere.');
                    window.location.href='dashboard-client.php'; 
                  </script>";
            exit();
        }
    } else {
        // Agar record match na kare
        $error_msg = "Invalid Email or Password! Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in | PetSphere</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
/* ===== GOOGLE FONT ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght=300;400;500;600;700;800;900&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url('https://thumbs.dreamstime.com/b/charming-dog-paw-print-photo-frame-perfect-addition-to-your-pet-blog-website-capture-essence-furry-friend-404837888.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
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

.login-btn {
    background-color: orange;
    border: 2px solid orange;
    color: black;
}

.login-btn:hover {
    background-color: transparent;
    color: black;
}

.signup-btn {
    background-color: black;
    color: white;
    border: 2px solid black;
}

.signup-btn:hover {
    background-color: white;
    color: black;
}

/* ================= MAIN CONTENT ================= */
.main-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 80px; /* Navbar padding space */
}

.logimn-box {
    width: 380px;
    background: #ffffff;
    padding: 35px;
    border-radius: 18px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.logimn-box h2 {
    margin-bottom: 20px;
    font-size: 28px;
    font-weight: bold;
    color: #222;
}

.input-box input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #999;
    padding: 12px 0;
    margin-bottom: 25px;
    outline: none;
    font-size: 15px;
}

.remember-box {
    margin-bottom: 25px;
    font-size: 14px;
    color: #555;
}

.loginnn-btn {
    width: 100%;
    padding: 12px;
    border-radius: 30px;
    border: 2px solid #333;
    background: #ffffff;
    font-size: 16px;
    cursor: pointer;
    font-weight: bold;
    transition: 0.3s;
}

.loginnn-btn:hover {
    background: orange;
    border-color: orange;
}

.bottom-links {
    margin-top: 18px;
    display: flex;
    justify-content: space-between;
}

.bottom-links a {
    text-decoration: none;
    color: darkred;
    font-size: 14px;
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
            <a href="firstpage.php#about">About</a>
            <a href="firstpage.php#shop">Shop</a>
            <a href="firstpage.php#Services">Services</a>
            <a href="firstpage.php#Medicines">Medicines</a>
            <a href="firstpage.php#Contact">Contact</a>
        </nav>
        
        <div class="auth-buttons">
            <a href="login.php" class="btn login-btn">Login</a>
            <a href="signup.php" class="btn signup-btn">Sign Up</a>
        </div>
    </header>

    <div class="main-container">
        <div class="logimn-box">

            <h2>LOGIN IN</h2>

            <?php if(!empty($error_msg)): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; font-weight: 500;">
                    <i class="fas fa-exclamation-circle"></i> <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" action="login.php" method="POST">
                <input type="hidden" name="submit_login" value="1">

                <div class="input-box">
                    <input type="email" name="email" placeholder="enter your email" required>
                </div>

                <div class="input-box">
                    <input type="password" name="password" placeholder="enter your password" required>
                </div>

                <div class="remember-box">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <button type="submit" class="loginnn-btn">Login in</button>

                <div class="bottom-links">
                    <a href="#">Forgot Password</a>
                    <a href="signup.php">Sign Up</a>
                </div>
            </form>

        </div>
    </div>

</body>
</html>