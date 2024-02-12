<?php
// Establish a connection to your MySQL database
$servername = "localhost"; // Change this to your database server's hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password (if applicable)
$dbname = "EmpowerHerBangladesh"; // Change this to your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form data and insert into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $amount = $_POST["amount"];
    $message = $_POST["message"];
    $paymentMethod = $_POST["paymentMethod"];

    // Prepare and execute the SQL statement to insert data into the database
    $sql = "INSERT INTO donors (name, email, amount, message, paymentMethod) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdss", $name, $email, $amount, $message, $paymentMethod);

    if ($stmt->execute()) {
        echo "Donor information saved successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
