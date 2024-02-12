<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact_form_db";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $country = $_POST['country'];
    $message = $_POST['message'];

    // Insert the data into the database
    $sql = "INSERT INTO contact_form (firstname, lastname, email, country, message)
            VALUES ('$firstname', '$lastname', '$email', '$country', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Data submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
