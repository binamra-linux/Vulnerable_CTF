<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logged Out - SecureFile Manager</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; }
        .btn { background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn:hover { background: #005a8a; }
    </style>
</head>
<body>
    <div class="container">
        <h1>👋 Logged Out Successfully</h1>
        <p>You have been logged out of the SecureFile Manager system.</p>
        <p>Thank you for using our service!</p>
        <a href="index.php" class="btn">Return to Home</a>
    </div>
</body>
</html>
