<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection parameters (replace with your database credentials)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "EmpowerHerBangladesh";

    // Create a database connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get and sanitize input values from the form
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $dob = sanitizeInput($_POST["dob"]);
    $address = sanitizeInput($_POST["address"]);
    $phone = sanitizeInput($_POST["phone"]);
    $agree = isset($_POST["agree"]) ? 1 : 0; // Convert checkbox value to 1 (checked) or 0 (unchecked)

    // Function to sanitize input data
    function sanitizeInput($input) {
        global $conn;
        return mysqli_real_escape_string($conn, $input);
    }

    // Perform validation (you can add more validation checks as needed)
    if (empty($username) || empty($email) || empty($password) || empty($dob) || empty($address) || empty($phone)) {
        echo "Error: All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
    } else {
        // Insert data into the database
        $sql = "INSERT INTO register (username, email, password, dob, address, phone, agree)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssssssi", $username, $email, $password, $dob, $address, $phone, $agree);

            if ($stmt->execute()) {
                // Registration successful
                echo "Registration successful!";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
