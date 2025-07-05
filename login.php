<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "ctf_user";
$password = "ctf_password";
$dbname = "ctf_database";

$error_message = "";
$success_message = "";

if ($_POST) {
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $user = $_POST['username'];
        $pass = $_POST['password'];
        
        // VULNERABLE: Direct SQL injection without prepared statements
        // Multiple vulnerabilities for different SQLi techniques
        $query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
        
        // Debug mode - shows the actual query (helpful for SQLi)
        if (isset($_GET['debug']) && $_GET['debug'] == '1') {
            echo "<div style='background: #f0f0f0; padding: 10px; margin: 10px; border: 1px solid #ccc;'>";
            echo "<strong>Debug Query:</strong> " . htmlspecialchars($query);
            echo "</div>";
        }
        
        $result = $pdo->query($query);
        
        if ($result && $result->rowCount() > 0) {
            $user_data = $result->fetch(PDO::FETCH_ASSOC);
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['user_role'] = $user_data['role'];
            
            $success_message = "Login successful! Welcome " . htmlspecialchars($user_data['username']) . "!";
            
            // Show user role if admin
            if (isset($user_data['role']) && $user_data['role'] === 'admin') {
                $success_message .= " (Admin Access Granted)";
            }
            
            header("refresh:3;url=dashboard.php");
        } else {
            $error_message = "Invalid username or password!";
        }
        
    } catch(PDOException $e) {
        // Show detailed error for SQLi exploitation - this helps with error-based SQLi
        $error_message = "Database Error: " . $e->getMessage();
        
        // Additional debugging for union-based SQLi
        if (isset($_GET['debug']) && $_GET['debug'] == '1') {
            echo "<div style='background: #ffebee; padding: 10px; margin: 10px; border: 1px solid #f44336;'>";
            echo "<strong>Full Error Details:</strong><br>";
            echo "Error Code: " . $e->getCode() . "<br>";
            echo "Error Message: " . $e->getMessage() . "<br>";
            echo "Query: " . htmlspecialchars($query);
            echo "</div>";
        }
    }
}

// Show database schema hint for advanced players
if (isset($_GET['schema']) && $_GET['schema'] == '1') {
    echo "<div style='background: #e3f2fd; padding: 15px; margin: 10px; border: 1px solid #2196f3; border-radius: 4px;'>";
    echo "<strong>Database Schema Hint:</strong><br>";
    echo "Table: users<br>";
    echo "Columns: id, username, password, email, role, created_at<br>";
    echo "Additional Tables: files, logs, config<br>";
    echo "<em>Try using UNION SELECT to extract data!</em>";
    echo "</div>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>SecureFile Manager - Login</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        .btn { background: #007cba; color: white; padding: 12px 24px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
        .btn:hover { background: #005a8a; }
        .error { color: #d32f2f; background: #ffebee; padding: 10px; border-radius: 4px; margin: 10px 0; word-wrap: break-word; }
        .success { color: #388e3c; background: #e8f5e8; padding: 10px; border-radius: 4px; margin: 10px 0; }
        .hint { background: #fff3cd; border: 1px solid #ffeaa7; padding: 15px; border-radius: 4px; margin-top: 20px; }
        .debug-link { margin-top: 10px; font-size: 12px; }
        .debug-link a { color: #666; text-decoration: none; }
        .debug-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔐 SecureFile Manager Login</h1>
        <p>Please enter your credentials to access the file management system.</p>
        
        <?php if ($error_message): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <?php if ($success_message): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn">Login</button>
        </form>
        
        <p><a href="index.php">← Back to Home</a></p>
    </div>
</body>
</html>
