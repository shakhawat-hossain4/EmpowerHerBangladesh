<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "EmpowerHerBangladesh2"; 

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form and sanitize inputs
$name = sanitizeInput($_POST["name"]);
$age = sanitizeInput($_POST["age"]);
$bloodPressure = sanitizeInput($_POST["bloodPressure"]);
$bmi = sanitizeInput($_POST["bmi"]);
$height = sanitizeInput($_POST["height"]);
$weight = sanitizeInput($_POST["weight"]);
$heartRate = sanitizeInput($_POST["heartRate"]);
$date = sanitizeInput($_POST["date"]);

// Function to sanitize input data
function sanitizeInput($input) {
    // Use appropriate sanitization techniques based on your requirements.
    // For example, you can use mysqli_real_escape_string for basic protection.
    global $conn;
    return mysqli_real_escape_string($conn, $input);
}

// Insert data into the database using prepared statements to prevent SQL injection
$sql = "INSERT INTO health_data (name, age, blood_pressure, bmi, height, weight, heart_rate, date)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    // Bind parameters with their respective data types
    $stmt->bind_param("ssssssss", $name, $age, $bloodPressure, $bmi, $height, $weight, $heartRate, $date);

    // Execute the statement
    if ($stmt->execute()) {
        // Define an associative array to hold the response message and advice
        $response = array(
            "message" => "Data has been saved",
            "advice" => ""
        );

        // Analyze BMI and provide advice
        if (!empty($bmi)) {
            $bmi = floatval($bmi);

            if ($bmi < 18.5) {
                $response["advice"] = "Your BMI indicates that you are underweight. Consider consulting a healthcare professional.";
            } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
                $response["advice"] = "Your BMI is within the normal range. Keep up the good work!";
            } elseif ($bmi >= 25 && $bmi <= 29.9) {
                $response["advice"] = "Your BMI indicates that you are overweight. Consider maintaining a healthy diet and exercising regularly.";
            } else {
                $response["advice"] = "Your BMI indicates that you are obese. It's important to consult a healthcare professional and consider a weight management plan.";
            }
        }

        // Encode the response as JSON and echo it
        echo json_encode($response);
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
