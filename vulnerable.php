<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // Redirect non-admin users or show access denied
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Access Denied</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
            .container { max-width: 600px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
            .access-denied { background: #ffebee; border: 1px solid #f44336; padding: 20px; border-radius: 4px; color: #d32f2f; text-align: center; }
            .btn { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; display: inline-block; margin-top: 15px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="access-denied">
                <h1>🚫 Access Denied</h1>
                <p><strong>Error:</strong> This page requires admin privileges.</p>
                <p>Current user: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
                
                <a href="dashboard.php" class="btn">← Back to Dashboard</a>
                <a href="logout.php" class="btn">Logout</a>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>File Viewer - Authenticated Access</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 900px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .nav { background: #007cba; padding: 15px; margin: -30px -30px 20px; border-radius: 8px 8px 0 0; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; }
        .nav a:hover { text-decoration: underline; }
        .file-content { background: #f9f9f9; padding: 15px; border: 1px solid #ddd; margin-top: 20px; font-family: monospace; white-space: pre-wrap; }
        input[type="text"] { width: 70%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        .btn { background: #007cba; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #005a8a; }
        .examples { background: #fff3cd; padding: 15px; border-radius: 4px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="nav">
            <a href="dashboard.php">🏠 Dashboard</a>
            <a href="vulnerable.php">📁 File Viewer</a>
            <a href="logout.php">🚪 Logout</a>
        </div>
        
        <h1>📁 Advanced File Viewer System</h1>
        <p>Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! You can now include and view files from local or remote sources.</p>
        
        <h2>🔍 File Viewer Interface</h2>
        <form method="GET">
            <label for="file">File path</label><br><br>
            <input type="text" name="file" id="file" placeholder="" value="<?php echo isset($_GET['file']) ? htmlspecialchars($_GET['file']) : ''; ?>">
            <input type="submit" value="Load File" class="btn">
        </form>
        
        <?php
        if (isset($_GET['file'])) {
            $file = $_GET['file'];
            echo "<div class='file-content'>";
            echo "<h3>📄 File Content for: " . htmlspecialchars($file) . "</h3>";
            echo "<hr>";
            
            // VULNERABLE: Direct inclusion without any sanitization
            // This allows both LFI and RFI attacks for authenticated users
            try {
                include($file);
            } catch (Exception $e) {
                echo "Error loading file: " . $e->getMessage();
            }
            
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>