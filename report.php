<?php
// Function to calculate grade based on marks
function calculateGrade($marks)
{
    if ($marks >= 75) {
        return "Distinction";
    } elseif ($marks >= 60 && $marks <= 74) {
        return "First Class";
    } elseif ($marks >= 33 && $marks <= 59) {
        return "Pass";
    } else {
        return "Fail";
    }
}

// Function to validate alphabetic input
function validateAlphabetic($input)
{
    return preg_match("/^[a-zA-Z]+$/", $input);
}

// Function to validate numeric input
function validateNumeric($input)
{
    return is_numeric($input);
}

// Function to validate email address
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate decimal input
function validateDecimal($input)
{
    return preg_match("/^\d+(\.\d+)?$/", $input);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentId = $_POST["student_id"];
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $batchClass = $_POST["batch_class"];
    $email = $_POST["email"];
    $englishMarks = $_POST["english_marks"];
    $hindiMarks = $_POST["hindi_marks"];
    $mathMarks = $_POST["math_marks"];
    $scienceMarks = $_POST["science_marks"];
    $historyMarks = $_POST["history_marks"];
    $geographyMarks = $_POST["geography_marks"];
    $remarks = $_POST["remarks"];

    // Validation
    $isValid = true;
    $errors = [];

    if (!validateNumeric($studentId)) {
        $isValid = false;
        $errors[] = "Invalid student ID. Please enter a numeric value.";
    }

    if (!validateAlphabetic($firstName)) {
        $isValid = false;
        $errors[] = "Invalid first name. Please enter alphabets only.";
    }

    if (!validateAlphabetic($lastName)) {
        $isValid = false;
        $errors[] = "Invalid last name. Please enter alphabets only.";
    }

    if (empty($batchClass)) {
        $isValid = false;
        $errors[] = "Batch/Class cannot be empty.";
    }

    if (!validateEmail($email)) {
        $isValid = false;
        $errors[] = "Invalid email address.";
    }

    if (!validateDecimal($englishMarks) || !validateDecimal($hindiMarks) || !validateDecimal($mathMarks) || !validateDecimal($scienceMarks) || !validateDecimal($historyMarks) || !validateDecimal($geographyMarks)) {
        $isValid = false;
        $errors[] = "Invalid marks entered. Please enter numeric values.";
    }

    if ($isValid) {
        // Calculate total marks and average
        $totalMarks = $englishMarks + $hindiMarks + $mathMarks + $scienceMarks + $historyMarks + $geographyMarks;
        $averageMarks = $totalMarks / 6;

        // Generate grade based on average marks
        $grade = calculateGrade($averageMarks);

        // Display the student report
        echo "<h2>Student Report</h2>";
        echo "<p><strong>Student ID:</strong> $studentId</p>";
        echo "<p><strong>Name:</strong> $firstName $lastName</p>";
        echo "<p><strong>Batch/Class:</strong> $batchClass</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Marks:</strong></p>";
        echo "<ul>";
        echo "<li>English: $englishMarks</li>";
        echo "<li>Hindi: $hindiMarks</li>";
        echo "<li>Math: $mathMarks</li>";
        echo "<li>Science: $scienceMarks</li>";
        echo "<li>History: $historyMarks</li>";
        echo "<li>Geography: $geographyMarks</li>";
        echo "</ul>";
        echo "<p><strong>Total Marks:</strong> $totalMarks</p>";
        echo "<p><strong>Average Marks:</strong> $averageMarks</p>";
        echo "<p><strong>Grade:</strong> $grade</p>";
        echo "<p><strong>Remarks:</strong> $remarks</p>";
    } else {
        // Display errors
        echo "<h2>Error</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>

    <div class="container">
        <h2>Student Report</h2>

        <form>
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="student_id" class="col-sm-2 col-form-label">Student ID:</label>
                    <input type="number" class="form-control" name="student_id" id="student_id" required>
                </div>
                <div class="col-md-6">
                    <label for="first_name" class="col-sm-2 col-form-label">First Name:</label>
                    <input type="text" class="form-control" name="first_name" id="first_name" required>
                </div>
                <div class="col-md-6">
                    <label for="last_name" class="col-sm-2 col-form-label">Last Name:</label>
                    <input type="text" class="form-control" name="last_name" id="last_name" required>
                </div>
                <div class="col-md-6">
                    <label for="batch_class" class="col-sm-2 col-form-label">Batch/Class:</label>
                    <input type="text" class="form-control" name="batch_class" id="batch_class" required>
                </div>

                <div class="col-md-12">
                    <label for="email" class="col-sm-2 col-form-label">Email Address:</label>
                    <input type="text" class="form-control" name="email" id="email" required>
                </div>
            </div>
          <!-- <div class="row mb-3">
            <label for="student_id" class="col-sm-2 col-form-label">Student ID:</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" name="student_id" id="student_id" required>
            </div>
          </div>
          
          <div class="row mb-3">
            <label for="first_name" class="col-sm-2 col-form-label">First Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="first_name" id="first_name" required>
            </div>
          </div> -->

          <!-- <div class="row mb-3">
            <label for="last_name" class="col-sm-2 col-form-label">Last Name:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="last_name" id="last_name" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="batch_class" class="col-sm-2 col-form-label">Batch/Class:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="batch_class" id="batch_class" required>
            </div>
          </div> -->

          <!-- <div class="row mb-3">
            <label for="email" class="col-sm-2 col-form-label">Email Address:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="email" id="email" required>
            </div>
          </div> -->


          <div class="row mb-3">
            <label for="english_marks" class="col-sm-2 col-form-label">English Marks:</label>
            <div class="col-sm-10">
              <input type="number" step="0.01" min="0" max="100" class="form-control" name="english_marks" id="english_marks" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="hindi_marks" class="col-sm-2 col-form-label">Hindi Marks:</label>
            <div class="col-sm-10">
              <input type="number" step="0.01" min="0" max="100" class="form-control" name="hindi_marks" id="hindi_marks" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="math_marks" class="col-sm-2 col-form-label">Math Marks:</label>
            <div class="col-sm-10">
              <input type="number" step="0.01" min="0" max="100" class="form-control" name="math_marks" id="math_marks" required>
            </div>
          </div>
          
          <div class="row mb-3">
            <label for="science_marks" class="col-sm-2 col-form-label">Science Marks:</label>
            <div class="col-sm-10">
              <input type="number" step="0.01" min="0" max="100" class="form-control" name="science_marks" id="science_marks" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="history_marks" class="col-sm-2 col-form-label">History Marks:</label>
            <div class="col-sm-10">
              <input type="number" step="0.01" min="0" max="100" class="form-control" name="history_marks" id="history_marks" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="geography_marks" class="col-sm-2 col-form-label">Geography Marks:</label>
            <div class="col-sm-10">
              <input type="number" step="0.01" min="0" max="100" class="form-control" name="geography_marks" id="geography_marks" required>
            </div>
          </div>

          <div class="row mb-3">
            <label for="geography_marks" class="col-sm-2 col-form-label">Remarks:</label>
            <div class="col-sm-10">
                <textarea class="form-control" name="remarks" rows="4" cols="50" maxlength="150"></textarea>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>