<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "EmpowerHerBangladesh";

    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get input values from the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize input data (you can add more validation as needed)
    $email = sanitizeInput($email);
    $password = sanitizeInput($password);

    // Function to sanitize input data
    function sanitizeInput($input) {
        global $conn;
        return mysqli_real_escape_string($conn, $input);
    }

    // Check the credentials against the database (replace 'users' with your actual user table name)
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Set the user as logged in (you can use sessions or tokens for this)
        // Redirect to the homepage after successful login
        header("Location: homepage.html");
        exit();
    } else {
        // Display an error message to the user
        $errorMessage = "Invalid email or password. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>
