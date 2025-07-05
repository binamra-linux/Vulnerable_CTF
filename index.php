<?php
session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SecureFile Manager - Login Required</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .login-box { background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 5px; margin-top: 20px; }
        .btn { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #005a8a; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ddd; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔒 SecureFile Manager</h1>
        <p>Welcome to our secure file management system. Please login to access the file viewer and management tools.</p>
        
        <div class="login-box">
            <h2>Login Required</h2>
            <p>You must authenticate to access this system.</p>
            <a href="login.php" class="btn">Go to Login Page</a>
        </div>
        
        <h3>System Features (Authenticated Users Only):</h3>
        <ul>
            <li>🔍 Advanced file viewing</li>
            <li>⚙️ Administrative file management tools</li>
        </ul>
        
    </div>
</body>
</html>
