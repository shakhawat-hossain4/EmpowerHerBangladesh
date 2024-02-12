<?php
// Database configuration
$servername = "localhost"; // Change to your database server name if different
$username = "root"; // Change to your MySQL username
$password = ""; // Change to your MySQL password
$dbname = "EmpowerHerBangladesh"; // Change to your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get JSON data from the POST request
$data = json_decode(file_get_contents("php://input"));

// Extract data
$opinionText = $data->opinion;

// Implement your logic to handle user opinions here
// You can store them in the database or perform other actions

$response = array();
$response["message"] = "Opinion submitted successfully.";

// Close the database connection
$conn->close();

// Send JSON response
header("Content-Type: application/json");
echo json_encode($response);
?>
