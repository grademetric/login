<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qpal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for user management
$message = '';
$user_id = null; // Default value for user_id

// Registration and update form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($conn->real_escape_string($_POST['password']), PASSWORD_DEFAULT); // Secure password
    $studentName = $conn->real_escape_string($_POST['StudentName']);
    $course = $conn->real_escape_string($_POST['Course']);
    $schoolEmail = $conn->real_escape_string($_POST['SchoolEmail']);
    $user_type = $conn->real_escape_string($_POST['user_type']);

    // Check if we are adding a new user or updating an existing one
    if (isset($_POST['update']) && isset($_POST['user_id'])) {
        // Update user details
        $user_id = (int)$_POST['user_id'];
        $sql = "UPDATE users SET 
                username = '$username', 
                password = '$password', 
                StudentName = '$studentName', 
                Course = '$course', 
                SchoolEmail = '$schoolEmail', 
                user_type = '$user_type' 
                WHERE id = $user_id";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        // Insert a new user
        $sql = "INSERT INTO users (username, password, StudentName, Course, SchoolEmail, user_type) 
                VALUES ('$username', '$password', '$studentName', '$course', '$schoolEmail', '$user_type')";

        if ($conn->query($sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}

// Fetch user data if editing
if (isset($_GET['user_id'])) {
    $user_id = (int)$_GET['user_id'];
    $user_sql = "SELECT * FROM users WHERE id = $user_id";
    $user_result = $conn->query($user_sql);

    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
    } else {
        $user_id = null; // In case the user is not found
    }
}

// Delete user functionality
if (isset($_GET['delete'])) {
    $delete_id = (int)$_GET['delete'];
    $delete_sql = "DELETE FROM users WHERE id = $delete_id";

    if ($conn->query($delete_sql) === TRUE) {
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit();
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch all users for the user management table
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script>
type="text/javascript">
window.history.forward(); </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="usermanagement.css">
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
<div class="dashboard">
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <nav>
            <ul>
                <li><a href="index.php">Admin Dashboard</a></li>
                <li><a href="grading_system_management.php">Grading System</a></li>
                <li><a href="user_management.php">User Management</a></li>
                <li><a href="../login.php">Logout</a></li>
            </ul>
        </nav>
    </aside>

    <div class="container">
        <h1>User Management</h1>

        <!-- Display success or error messages -->
        <?php if (!empty($_GET['success'])): ?>
            <p class="message success">User added/updated successfully!</p>
        <?php elseif (!empty($message)): ?>
            <p class="message error"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <!-- User Form -->
        <div class="form-container">
            <h2><?= isset($user_id) ? 'Update User' : 'Add a New User' ?></h2>
            <form method="POST" action="process_user.php">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter username" 
                       value="<?= isset($user) ? htmlspecialchars($user['username']) : '' ?>" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter password"
                       value="<?= isset($user) ? htmlspecialchars($user['password']) : '' ?>" required>

                <label for="StudentName">Student Name:</label>
                <input type="text" id="StudentName" name="StudentName" placeholder="Enter student's name" 
                       value="<?= isset($user) ? htmlspecialchars($user['StudentName']) : '' ?>" required>

                <label for="Course">Course:</label>
                <input type="text" id="Course" name="Course" placeholder="Enter course" 
                       value="<?= isset($user) ? htmlspecialchars($user['Course']) : '' ?>" required>

                <label for="SchoolEmail">School Email:</label>
                <input type="email" id="SchoolEmail" name="SchoolEmail" placeholder="Enter school email" 
                       value="<?= isset($user) ? htmlspecialchars($user['SchoolEmail']) : '' ?>" required>

                <label for="user_type">User Type:</label>
                <select id="user_type" name="user_type" required>
                    <option value="student" <?= isset($user) && $user['user_type'] == 'student' ? 'selected' : '' ?>>Student</option>
                    <option value="admin" <?= isset($user) && $user['user_type'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>

                <?php if (isset($user)): ?>
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <button type="submit" name="update">Update User</button>
                <?php else: ?>
                    <button type="submit">Add User</button>
                <?php endif; ?>
            </form>
        </div>

        <!-- Users Table -->
        <h2>Existing Users</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>School Email</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']) ?></td>
                            <td><?= htmlspecialchars($row['StudentName']) ?></td>
                            <td><?= htmlspecialchars($row['Course']) ?></td>
                            <td><?= htmlspecialchars($row['SchoolEmail']) ?></td>
                            <td><?= htmlspecialchars($row['user_type']) ?></td>
                            <td>
                                <a href="?user_id=<?= $row['id'] ?>">Edit</a> |
                                <a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No users found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

