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

// Get expertId from the query string
$expertId = $_GET["expertId"];

// SQL query to retrieve chat messages for a specific expert
$sql = "SELECT message FROM chat_messages WHERE expert_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $expertId);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $messages = array();

    while ($row = $result->fetch_assoc()) {
        $messages[] = $row["message"];
    }

    $response["success"] = true;
    $response["messages"] = $messages;
} else {
    $response["success"] = false;
    $response["error"] = $conn->error;
}

// Close the database connection
$conn->close();

// Send JSON response
header("Content-Type: application/json");
echo json_encode($response);
?>
