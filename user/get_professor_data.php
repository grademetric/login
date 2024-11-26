<?php
// Database connection details
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'qpal';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch professor list
$professorQuery = "SELECT DISTINCT profName FROM grading_criteria";
$professorResult = $conn->query($professorQuery);

$professors = [];
if ($professorResult && $professorResult->num_rows > 0) {
    while ($row = $professorResult->fetch_assoc()) {
        $professors[] = $row['profName'];
    }
}

// Fetch grading data if professor is selected
$gradingData = [];
if (isset($_GET['professor'])) {
    $professorName = $_GET['professor'];

    // Use prepared statement to prevent SQL injection
    $query = "SELECT 
                quiz_weight AS quizPercent, 
                activity_weight AS activityPercent, 
                assignment_weight AS assignmentPercent, 
                project_weight AS projectPercent, 
                recitation_weight AS recitationPercent, 
                attendance_weight AS attendancePercent, 
                summative_weight AS summativePercent, 
                exam_weight AS examPercent
              FROM grading_criteria 
              WHERE profName = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Statement preparation failed: ' . $conn->error);
    }

    $stmt->bind_param("s", $professorName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $gradingData = $result->fetch_assoc();
    }

    $stmt->close();
}

// Close the database connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode(['professors' => $professors, 'gradingData' => $gradingData]);
?>
