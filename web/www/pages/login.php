<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
<section>
    <div class="form-box">
        <div class="form-value">
            <form action="/php/auth/login.php" method="POST">
                <h2>Overseer</h2>
                <div class="inputbox">
                    <ion-icon name="person-outline"></ion-icon>
                    <input type="text" name="username" required>
                    <label for="">Username</label>
                </div>
                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="password" required>
                    <label for="">Password</label>
                </div>
                <button type="submit">Log In</button>
                <div class="register-redirect">
                    <p>Don't have an account? <a href="/pages/register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</section>
<?php
if(isset($_GET["status"])) {
    $status = $_GET["status"];
    if($status == "loginfail")
    {
        echo "<script>alert('Failed Login!');</script>";
    }
    else if($status == "missinginput"){
        echo "<script>alert('Missing Input!');</script>";
    }
}
?>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
