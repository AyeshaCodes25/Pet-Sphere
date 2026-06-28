<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
    <style>
* ===== GOOGLE FONT ===== */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: 'Poppins', sans-serif;
}

body{
    background:#000;
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
    background-color: orange;
    border: 2px solid orange;
    color: black;
}

.login-btn:hover {
    background-color: transparent;
    color: black;
}

/* Signup Button */
.signup-btn {
    background-color: black;
    color: white;
    border: 2px solid black;
}

.signup-btn:hover {
    background-color: white;
    color: black;
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
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}
    body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-image: url('https://thumbs.dreamstime.com/b/charming-dog-paw-print-photo-frame-perfect-addition-to-your-pet-blog-website-capture-essence-furry-friend-404837888.jpg');  /* same background image */
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

.main-container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.signup-box {
    width: 380px;
    background: #ffffff;
    padding: 35px;
    border-radius: 18px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.signup-box h2 {
    text-align: center;
    margin-bottom: 30px;
    font-size: 28px;
}

.input-box {
    margin-bottom: 20px;
}

.input-box input {
    width: 100%;
    border: none;
    border-bottom: 1px solid #999;
    padding: 8px;
    outline: none;
    font-size: 14px;
}

button {
    width: 100%;
    padding: 12px;
    border: 2px solid #2c2c54;
    border-radius: 30px;
    background: transparent;
    cursor: pointer;
    font-size: 16px;
    margin-top: 15px;
}

button:hover {
    background: orange;
    color: white;
}

.links {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.links a {
    text-decoration: none;
    font-size: 13px;
    color: #b33939;
}

    </style>
</head>
<body>
   <!-- ===== NAVBAR ===== -->
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
    
<section>
    <div class="main-container">

        <div class="signup-box">
            <h2>SIGN UP</h2>

            <form id="signupForm">

                <div class="input-box">
                    <input type="text" placeholder="enter your name" required>
                </div>

                <div class="input-box">
                    <input type="email" placeholder="enter your email" required>
                </div>

                <div class="input-box">
                    <input type="password" placeholder="enter your password" required>
                </div>

                <div class="input-box">
                    <input type="password" placeholder="confirm your password" required>
                </div>

                <button type="submit">Sign Up</button>

                <div class="links">
                    <a href="#">Already have account?</a>
                    <a href="login.html">Login</a>
                </div>

            </form>
        </div>

    </div>
</section>

    <script>
        document.getElementById("signupForm").addEventListener("submit", function(e){

    e.preventDefault();

    alert("Sign Up Successful!");

});
<form action="login.php" method="get">

    </script>
</body>
</html>