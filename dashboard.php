<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SecureFile Manager - Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav { background: #007cba; padding: 15px; margin: -30px -30px 20px; border-radius: 8px 8px 0 0; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; }
        .nav a:hover { text-decoration: underline; }
        .welcome { background: #e8f5e8; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
        .feature-box { background: #f8f9fa; border: 1px solid #e9ecef; padding: 20px; margin: 15px 0; border-radius: 5px; }
        .btn { background: #007cba; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; display: inline-block; }
        .btn:hover { background: #005a8a; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="dashboard.php">🏠 Dashboard</a>
            <a href="vulnerable.php">📁 File Viewer</a>
            <a href="logout.php">🚪 Logout</a>
        </div>
        
        <div class="welcome">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>! 🎉</h2>
            <p>You have successfully authenticated and can now access all system features.</p>
        </div>
        
        <h1>📂 File Management Dashboard</h1>
        <p>You now have access to our advanced file management system.</p>
        
        <div class="feature-box">
            <h3>🔍 File Viewer</h3>
            <p>Our advanced file viewer</p>
            <ul>
                <li>View files</li>
                <li>User Activity Logs</li>
            </ul>
            <a href="vulnerable.php" class="btn">Access File Viewer</a>
        </div>
        
        <div class="feature-box">
            <h3>⚙️ System Information</h3>
            <p>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
            <p>User ID: <?php echo htmlspecialchars($_SESSION['user_id']); ?></p>
            <p>Session started: <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
        
    </div>
</body>
</html>
