<?php
// Start a session
session_start();

// Database connection (update with your actual database credentials)
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'qpal';

$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error_message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query to verify the user
    $stmt = $conn->prepare("SELECT * FROM users WHERE SchoolEmail = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // User found, check if they are admin
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $username; // Store username in session
        $_SESSION['user_type'] = $user['user_type']; // Store admin status in session
        
        // Redirect based on user role
        if ($user['user_type'] == 'admin') {
            header("Location: ../admin/index.php"); // Admin dashboard
        } else {
            header("Location: ../user/index.php"); // Regular user dashboard
        }
        exit();
    } else {
        // Invalid credentials
        $error_message = "Incorrect username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="../admin/login.css">
    <title>GradeMetric Login</title>
    <script languange='javascript'type='text/javascript'>
        function DisableBackButton(){
            window.history.forward()
        }
        window.onload=DisableBackButton;
        window.onpageshow=function(evet){ if (evet.persisted) DisableBackButton}
        window.onunload=function(){void (0)}
    </script>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="post" action="" autocomplete="off">
                <h1>Sign In</h1>
                <span>Sign in to your account</span>
                <input type="email" placeholder="Email" id="username" name="username" required>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <?php
                // Display error message if login fails
                if (!empty($error_message)) {
                    echo "<p style='color: red;'>$error_message</p>";
                }
                ?>
                <div class="button"><input type="submit" value="Login"></div>  
            </form>
            </div>
            <div class="toggle-container">
            <div class="toggle">
        </div>
            </div>
    </div>
</body>

</html>
