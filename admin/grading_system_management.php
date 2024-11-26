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

    // Handle form submission
    $message = '';
    $criteria_id = null; // Default value for criteria_id

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get form input
        $profName = $conn->real_escape_string($_POST['profName']);
        $quiz_weight = $conn->real_escape_string($_POST['quiz_weight']);
        $activity_weight = $conn->real_escape_string($_POST['activity_weight']);
        $assignment_weight = $conn->real_escape_string($_POST['assignment_weight']);
        $project_weight = $conn->real_escape_string($_POST['project_weight']);
        $recitation_weight = $conn->real_escape_string($_POST['recitation_weight']);
        $attendance_weight = $conn->real_escape_string($_POST['attendance_weight']);
        $summative_weight = $conn->real_escape_string($_POST['summative_weight']);
        $exam_weight = $conn->real_escape_string($_POST['exam_weight']);

        // Check if we are adding a new grading system or updating an existing one
        if (isset($_POST['update']) && isset($_POST['criteria_id'])) {
            // Update grading system
            $criteria_id = (int)$_POST['criteria_id'];
            if (empty($message)) {
                $sql = "UPDATE grading_criteria SET 
                        profName = '$profName', 
                        quiz_weight = '$quiz_weight', 
                        activity_weight = '$activity_weight', 
                        assignment_weight = '$assignment_weight', 
                        project_weight = '$project_weight', 
                        recitation_weight = '$recitation_weight', 
                        attendance_weight = '$attendance_weight', 
                        summative_weight = '$summative_weight', 
                        exam_weight = '$exam_weight'
                        WHERE criteria_id = $criteria_id";

                if ($conn->query($sql) === TRUE) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                    exit();
                } else {
                    $message = "Error: " . $conn->error;
                }
            }
        } else {
            // Insert a new grading system
            if (empty($message)) {
                $sql = "INSERT INTO grading_criteria 
                        (profName, quiz_weight, activity_weight, assignment_weight, project_weight, recitation_weight, attendance_weight, summative_weight, exam_weight) 
                        VALUES ('$profName', '$quiz_weight', '$activity_weight', '$assignment_weight', '$project_weight', '$recitation_weight', '$attendance_weight', '$summative_weight', '$exam_weight')";

                if ($conn->query($sql) === TRUE) {
                    header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
                    exit();
                } else {
                    $message = "Error: " . $conn->error;
                }
            }
        }
    }

    // Fetch grading system data if editing
    if (isset($_GET['criteria_id'])) {
        $criteria_id = (int)$_GET['criteria_id'];
        $product_sql = "SELECT * FROM grading_criteria WHERE criteria_id = $criteria_id";
        $product_result = $conn->query($product_sql);

        if ($product_result->num_rows > 0) {
            $grading_criteria = $product_result->fetch_assoc();
        } else {
            $criteria_id = null; // In case the grading system is not found
        }
    }

    if (isset($_GET['delete'])) {
        $delete_id = (int)$_GET['delete']; 
        $delete_sql = "DELETE FROM grading_criteria WHERE criteria_id = $delete_id";

        if ($conn->query($delete_sql) === TRUE) {
            header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
            exit();
        } else {
            $message = "Error: " . $conn->error;
        }
    }

    // Fetch grading criteria from the database
    $sql = "SELECT * FROM grading_criteria";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Grading System Management</title>
        <link rel="stylesheet" href="grading.css">
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
            <h1>Grading System Management</h1>

            <!-- Display success or error message -->
            <?php if (!empty($_GET['success'])): ?>
                <p class="message">Grading system added/updated successfully!</p>
            <?php elseif (!empty($message)): ?>
                <p class="message error"><?= htmlspecialchars($message) ?></p>
            <?php endif; ?>

            <!-- Grading System Form -->
            <div class="form-container">
                <h2><?= isset($criteria_id) ? 'Update Grading System' : 'Add a New Grading System' ?></h2>
                <form method="POST" action="">
                    <label for="profName">Professor Name:</label>
                    <input type="text" id="profName" name="profName" value="<?= isset($grading_criteria) ? htmlspecialchars($grading_criteria['profName']) : '' ?>" required>

                    <label for="quiz_weight">Quiz Percentage:</label>
                    <input type="number" id="quiz_weight" name="quiz_weight" value="<?= isset($grading_criteria) ? $grading_criteria['quiz_weight'] : '' ?>" required>

                    <label for="activity_weight">Activity Percentage:</label>
                    <input type="number" id="activity_weight" name="activity_weight" value="<?= isset($grading_criteria) ? $grading_criteria['activity_weight'] : '' ?>" required>

                    <label for="assignment_weight">Assignment Percentage:</label>
                    <input type="number" id="assignment_weight" name="assignment_weight" value="<?= isset($grading_criteria) ? $grading_criteria['assignment_weight'] : '' ?>" required>

                    <label for="project_weight">Project Percentage:</label>
                    <input type="number" id="project_weight" name="project_weight" value="<?= isset($grading_criteria) ? $grading_criteria['project_weight'] : '' ?>" required>

                    <label for="recitation_weight">Recitation Percentage:</label>
                    <input type="number" id="recitation_weight" name="recitation_weight" value="<?= isset($grading_criteria) ? $grading_criteria['recitation_weight'] : '' ?>" required>

                    <label for="attendance_weight">Attendance Percentage:</label>
                    <input type="number" id="attendance_weight" name="attendance_weight" value="<?= isset($grading_criteria) ? $grading_criteria['attendance_weight'] : '' ?>" required>

                    <label for="summative_weight">Summative Percentage:</label>
                    <input type="number" id="summative_weight" name="summative_weight" value="<?= isset($grading_criteria) ? $grading_criteria['summative_weight'] : '' ?>" required>

                    <label for="exam_weight">Exam Percentage:</label>
                    <input type="number" id="exam_weight" name="exam_weight" value="<?= isset($grading_criteria) ? $grading_criteria['exam_weight'] : '' ?>" required>

                    <?php if (isset($grading_criteria)): ?>
                        <input type="hidden" name="criteria_id" value="<?= $grading_criteria['criteria_id'] ?>">
                        <button type="submit" name="update">Update Grading System</button>
                    <?php else: ?>
                        <button type="submit">Add Grading System</button>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Grading Systems Table -->
            <h2>Existing Grading Systems</h2>
            <table border="1" cellspacing="0" cellpadding="8">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Quiz</th>
                        <th>Activity</th>
                        <th>Assignment</th>
                        <th>Project</th>
                        <th>Recitation</th>
                        <th>Attendance</th>
                        <th>Summative</th>
                        <th>Exam</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['profName']) ?></td>
                            <td><?= $row['quiz_weight'] ?>%</td>
                            <td><?= $row['activity_weight'] ?>%</td>
                            <td><?= $row['assignment_weight'] ?>%</td>
                            <td><?= $row['project_weight'] ?>%</td>
                            <td><?= $row['recitation_weight'] ?>%</td>
                            <td><?= $row['attendance_weight'] ?>%</td>
                            <td><?= $row['summative_weight'] ?>%</td>
                            <td><?= $row['exam_weight'] ?>%</td>
                            <td>
                                <a href="?criteria_id=<?= $row['criteria_id'] ?>">Edit</a> |
                                <a href="?delete=<?= $row['criteria_id'] ?>" onclick="return confirm('Are you sure you want to delete this grading system?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    </body>
    </html>

    <?php
    // Close the connection
    $conn->close();
    ?>
