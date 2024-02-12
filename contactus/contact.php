<?php
// Database configuration
$host = "localhost"; // Replace with your database hostname
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$database = "empowerherbangladesh"; // Replace with your database name

// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST["full-name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Validate input (you can add more validation as needed)
    if (empty($full_name) || empty($email) || empty($message)) {
        // Handle validation errors as needed
        echo "Please fill in all fields.";
    } else {
        // Use prepared statements to insert data
        $sql = "INSERT INTO contact_form (full_name, email, message) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $message);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Successful submission
            echo "Message sent successfully!";
        } else {
            // Handle database insertion errors
            echo "An error occurred. Please try again.";
        }
    }
}

mysqli_close($conn);
?>
