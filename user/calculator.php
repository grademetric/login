<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GRADEMETRIC</title>
    <link rel="stylesheet" href="usercalcu.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script languange='javascript'type='text/javascript'>
        function DisableBackButton(){
            window.history.forward()
        }
        window.onload=DisableBackButton;
        window.onpageshow=function(evet){ if (evet.persisted) DisableBackButton}
        window.onunload=function(){void (0)}
    </script>
    <script>

       document.addEventListener('DOMContentLoaded', async () => {
    const professorSelect = document.getElementById('professorSelect');
    const formInputs = document.querySelectorAll('#gradeForm input[type="number"]');

    // Fetch and populate the professors list
    try {
        const response = await fetch('get_professor_data.php');
        if (!response.ok) {
            throw new Error('Failed to fetch professor data');
        }
        const data = await response.json();

        // Populate the professor dropdown
        data.professors.forEach(prof => {
            const option = document.createElement('option');
            option.value = prof;
            option.textContent = prof;
            professorSelect.appendChild(option);
        });

        // Handle professor selection
        professorSelect.addEventListener('change', async () => {
            const selectedProfessor = professorSelect.value;
            const gradingResponse = await fetch(`get_professor_data.php?professor=${encodeURIComponent(selectedProfessor)}`);
            if (!gradingResponse.ok) {
                throw new Error('Failed to fetch grading data');
            }
            const gradingData = await gradingResponse.json();

            // Lock only the percentage input fields
            if (gradingData.gradingData) {
                Object.keys(gradingData.gradingData).forEach(key => {
                    const input = document.getElementById(key);
                    if (input && key.endsWith("Percent")) {  // Only lock percentage fields
                        input.value = gradingData.gradingData[key];
                        input.disabled = true; // Lock the percentage input fields
                    }
                });
            }
        });

        // Lock all percentage fields on page load
        formInputs.forEach(input => {
            if (input.id && input.id.endsWith("Percent")) {
                input.disabled = true; // Lock only percentage input fields
            }
        });
    } catch (error) {
        console.error('Error:', error.message);
    }
});

        // Add more rows function
        function addRow(containerId, type) {
            const container = document.getElementById(containerId);
            const newRow = document.createElement('div');
            newRow.classList.add(type + '-row');
            newRow.innerHTML = `
                <label for="${type}Score">${type.charAt(0).toUpperCase() + type.slice(1)} Score:</label>
                <input type="number" name="${type}Score" class="${type}Score" required>
                <input type="number" name="${type}Total" class="${type}Total" required placeholder="Total">
                <span class="delete-button" onclick="deleteRow(this)">Delete</span>
            `;
            container.appendChild(newRow);
        }

        // Delete row function
        function deleteRow(button) {
            const row = button.parentElement;
            row.remove();
        }

        // Reset form function
        function resetForm() {
            document.getElementById("gradeForm").reset();
        }
    </script>
</head>
<body>
    <div class="container">
        <nav>
            <div class="navbar">
                <div class="logo">
                    <img src="../image/image.logo.png" alt="logo">
                </div>
                <ul>
                    <li><a href="../user/index.php"><i class="fas fa fa-home"></i><span class="nav-item">Home</span></a></li>
                    <li><a href="calculator.php"><i class="fas fa fa-calculator"></i><span class="nav-item">Grade Calculator</span></a></li>
                    <li><a href="https://cityofmalabonuniversity.edu.ph"><i class="fas fa-school"></i><span class="nav-item">CMU Website</span></a></li>
                    <li><a href="http://124.105.153.226/"><i class="fas fa-graduation-cap"></i><span class="nav-item">CMU Portal</span></a></li>
                    <li><a href="../login.php"><i class="fas fa-sign-out-alt"></i><span class="nav-item">Logout</span></a></li>
                </ul>
            </div>
        </nav>

        <section class="main">
            <div class="main-top">
                <p>GRADEMETRIC</p>
            </div>
            <div class="main-body">
                <form id="gradeForm">
                    <h2>Percentage Grade</h2>
                    <div class="menu-bar">
                        <label for="professorSelect">Select Professor:</label>
                        <select id="professorSelect" class="select-bar">
                            <option value="" disabled selected>Select Professor</option>
                        </select>

                        <h2>Subjects Grading Percentage</h2>
                        <label for="quizPercent">Quiz %:</label>
                        <input type="number" id="quizPercent" name="quizPercent" min="0" max="100" step="0.1">

                        <label for="activityPercent">Activity %:</label>
                        <input type="number" id="activityPercent" name="activityPercent" min="0" max="100" step="0.1">

                        <label for="assignmentPercent">Assignment %:</label>
                        <input type="number" id="assignmentPercent" name="assignmentPercent" min="0" max="100" step="0.1">

                        <label for="projectPercent">Project %:</label>
                        <input type="number" id="projectPercent" name="projectPercent" min="0" max="100" step="0.1">

                        <label for="attendancePercent">Attendance %:</label>
                        <input type="number" id="attendancePercent" name="attendancePercent" min="0" max="100" step="0.1">

                        <label for="summativePercent">Summative Test %:</label>
                        <input type="number" id="summativePercent" name="summativePercent" min="0" max="100" step="0.1">

                        <label for="examPercent">Major Exam %:</label>
                        <input type="number" id="examPercent" name="examPercent" min="0" max="100" step="0.1">
                    </div>
                     <!-- Quiz Section -->
            <div id="quizContainer">
                <h3>Quizzes</h3>
                <div class="quiz-row">
                    <label for="quizScore">Quiz 1 Score:</label>
                    <input type="number" name="quizScore" class="quizScore" required>
                    <input type="number" name="quizTotal" class="quizTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <div class="add-more" onclick="addRow('quizContainer', 'quiz')">+ Add More Quiz</div>

            <!-- Activity Section -->
            <div id="activityContainer">
                <h3>Activities</h3>
                <div class="activity-row">
                    <label for="activityScore">Activity 1 Score:</label>
                    <input type="number" name="activityScore" class="activityScore" required>
                    <input type="number" name="activityTotal" class="activityTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <div class="add-more" onclick="addRow('activityContainer', 'activity')">+ Add More Activity</div>

            <!-- Assignment Section -->
            <div id="assignmentContainer">
                <h3>Assignments</h3>
                <div class="assignment-row">
                    <label for="assignmentScore">Assignment 1 Score:</label>
                    <input type="number" name="assignmentScore" class="assignmentScore" required>
                    <input type="number" name="assignmentTotal" class="assignmentTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <div class="add-more" onclick="addRow('assignmentContainer', 'assignment')">+ Add More Assignment</div>

            <!-- Project Section -->
            <div id="projectContainer">
                <h3>Projects</h3>
                <div class="project-row">
                    <label for="projectScore">Project 1 Score:</label>
                    <input type="number" name="projectScore" class="projectScore" required>
                    <input type="number" name="projectTotal" class="projectTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <div class="add-more" onclick="addRow('projectContainer', 'project')">+ Add More Project</div>

            <!-- Recitation Section -->
            <div id="recitationContainer">
                <h3>Recitations</h3>
                <div class="recitation-row">
                    <label for="recitationScore">Recitation 1 Score:</label>
                    <input type="number" name="recitationScore" class="recitationScore" required>
                    <input type="number" name="recitationTotal" class="recitationTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <div class="add-more" onclick="addRow('recitationContainer', 'recitation')">+ Add More Recitation</div>

            <!-- Attendance Section -->
            <div id="attendanceContainer">
                <h3>Attendances</h3>
                <div class="attendance-row">
                    <label for="attendanceScore">Attendance 1 Score:</label>
                    <input type="number" name="attendanceScore" class="attendanceScore" required>
                    <input type="number" name="attendanceTotal" class="attendanceTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <div class="add-more" onclick="addRow('attendanceContainer', 'attendance')">+ Add More Attendance</div>
            
            <!-- Summative Test Section -->
            <div id="summativeContainer">
               <h3>Summative Tests</h3>
                <div class="summative-row">
                    <label for="summativeScore">Summative Test 1 Score:</label>
                    <input type="number" name="summativeScore" class="summativeScore" required>
                    <input type="number" name="summativeTotal" class="summativeTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <div class="add-more" onclick="addRow('summativeContainer', 'summative')">+ Add More Summative</div>

            <!-- Major Exam Section -->
            <div id="examContainer">
                <h3>Major Exams (Prelim, Midterm, Final)</h3>
                <div class="exam-row">
                    <label for="examScore">Prelim Score:</label>
                    <input type="number" name="prelimScore" class="examScore" required>
                    <input type="number" name="prelimTotal" class="examTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
                <div class="exam-row">
                    <label for="examScore">Midterm Score:</label>
                    <input type="number" name="midtermScore" class="examScore" required>
                    <input type="number" name="midtermTotal" class="examTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
                <div class="exam-row">
                    <label for="examScore">Final Exam Score:</label>
                    <input type="number" name="finalScore" class="examScore" required>
                    <input type="number" name="finalTotal" class="examTotal" required placeholder="Total">
                    <span class="delete-button" onclick="deleteRow(this)">Delete</span>
                </div>
            </div>
            <h2>
                <button type="submit">Calculate Grade</button>
            </h2>
        </form>

        <div id="result">
            <h2>Grade Calculation Result</h2>
            <p id="finalGrade"></p>
            <p id="letterGrade"></p> <p id="gradePoint"></p>
            <p id="feedback"></p>
            <button onclick="resetForm()">Reset</button>
            <button type="save" value="Save">Save</button>
        </div>
    </div>
    <script>
document.getElementById("gradeForm").onsubmit = function(event) {
    event.preventDefault(); // Prevent default form submission

    let finalGrade = 0;
    let totalWeight = 0;

    // Calculate grades for each section
    const sections = ["quiz", "activity", "assignment", "project", "recitation", "attendance", "summative"];
    for (let section of sections) {
        const weight = getWeight(section);
        const sectionGrade = calculateSection(section);

        if (sectionGrade === null) {
            alert(`Error in the ${capitalize(section)} section: Ensure all scores are valid.`);
            return;
        }

        if (weight > 0) {
            finalGrade += sectionGrade * weight;
            totalWeight += weight;
        }
    }

    // Calculate Major Exam grades separately
    const examWeight = getWeight("exam");
    const examGrade = calculateMajorExam();

    if (examGrade === null) {
        alert("Error in the Major Exam section: Ensure all scores are valid.");
        return;
    }

    finalGrade += examGrade * examWeight;
    totalWeight += examWeight;

    // Ensure total weight is valid
    if (totalWeight === 0) {
        alert("Total weight is zero. Please input valid percentages.");
        return;
    }

    // Final grade calculation
    const percentageGrade = (finalGrade / totalWeight * 100).toFixed(2);

    // Display final grade, feedback, and grading details
    document.getElementById("finalGrade").innerText = `Final Grade: ${percentageGrade}%`;
    document.getElementById("feedback").innerText = generateFeedback(percentageGrade);
    document.getElementById("gradePoint").innerText = `Grade Point: ${getGradePoint(percentageGrade)}`;

    // Show the result section
    document.getElementById("result").style.display = "block";
};

function getWeight(section) {
    const weightInput = document.getElementById(section + "Percent");
    return weightInput ? parseFloat(weightInput.value) / 100 : 0;
}

function calculateSection(section) {
    let totalScore = 0, totalMax = 0;
    const scores = document.querySelectorAll(`.${section}Score`);
    const totals = document.querySelectorAll(`.${section}Total`);

    scores.forEach((scoreInput, i) => {
        const score = parseFloat(scoreInput.value) || 0;
        const maxScore = parseFloat(totals[i].value) || 0;

        if (score > maxScore) totalMax = NaN; // Invalid input
        totalScore += score;
        totalMax += maxScore;
    });

    return isNaN(totalMax) ? null : (totalMax > 0 ? totalScore / totalMax : 0);
}

function calculateMajorExam() {
    let totalScore = 0, totalMax = 0;
    const exams = ["prelim", "midterm", "final"];

    exams.forEach(exam => {
        const score = parseFloat(document.querySelector(`input[name="${exam}Score"]`).value) || 0;
        const maxScore = parseFloat(document.querySelector(`input[name="${exam}Total"]`).value) || 0;

        if (score > maxScore) totalMax = NaN; // Invalid input
        totalScore += score;
        totalMax += maxScore;
    });

    return isNaN(totalMax) ? null : (totalMax > 0 ? totalScore / totalMax : 0);
}

function generateFeedback(grade) {
    if (grade >= 75) return "Congratulations! You passed.";
    if (grade >= 61) return "You did not pass.";
    return "You did not pass. You got an INC.";
}

function getGradePoint(grade) {
    if (grade >= 99) return "1.0";
    if (grade >= 96) return "1.25";
    if (grade >= 93) return "1.5";
    if (grade >= 90) return "1.75";
    if (grade >= 87) return "2.0";
    if (grade >= 84) return "2.25";
    if (grade >= 81) return "2.5";
    if (grade >= 78) return "2.75";
    if (grade >= 75) return "3.0";
    if (grade >= 61) return "4.0";
    return "5.0";
}

function capitalize(word) {
    return word.charAt(0).toUpperCase() + word.slice(1);
}

function resetForm() {
    document.getElementById("gradeForm").reset();
    document.getElementById("result").style.display = "none";
}
</script>


</body>
</html>

                   