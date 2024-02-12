<?php

$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "EmpowerHerBangladesh3"; 

// Create a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST["full-name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $date = $_POST["date"];
    $course = $_POST["course"];

    // Validate the data (you can add more specific validation if needed)
    if (empty($full_name) || empty($email) || empty($phone) || empty($address) || empty($date) || empty($course)) {
        echo "Please fill in all required fields.";
    } else {
        // SQL query to insert data into the database (update table name and column names)
        $sql = "INSERT INTO enrollments (full_name, email, phone, address, date, course) VALUES ('$full_name', '$email', '$phone', '$address', '$date', '$course')";

        if ($conn->query($sql) === TRUE) {
            echo "Enrollment successful! Your data has been recorded.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


$conn->close();
?>
