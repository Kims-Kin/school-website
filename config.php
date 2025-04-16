[09:39, 2/26/2025] +254 745 411789: <?php
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');  // default XAMPP username
define('DB_PASS', '');      // default XAMPP password
define('DB_NAME', 'school_db');

// Create database connection
try {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }
    
    // Set charset to UTF8
    mysqli_set_charset($conn, "utf8");
    
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define base URL - adjust according to your setup
define('BASE_URL', '/school/');

// Time zone setting
date_default_timezone_set('UTC'); // Change to your timezone

// Define upload directory
define('UPLOAD_DIR', _DIR_ . '/../uploads/');

// Start or resume session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
[09:44, 2/26/2025] +254 745 411789: <?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "user_system";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            echo "Login successful!";
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login & Registration</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; text-align: center; }
        .container { width: 300px; margin: auto; padding: 20px; background: white; border-radius: 5px; box-shadow: 0px 0px 10px gray; }
        input { width: 100%; padding: 10px; margin: 5px 0; }
        button { background: #28a745; color: white; padding: 10px; width: 100%; border: none; }
        button:hover { background: #218838; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
    
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>