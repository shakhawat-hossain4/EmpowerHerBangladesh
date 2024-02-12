<?php

$mysqli = new mysqli("localhost", "your_username", "your_password", "your_database_name");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM experts";
$result = $mysqli->query($sql);
$experts = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $experts[] = $row;
    }
}

$mysqli->close();

header('Content-Type: application/json');
echo json_encode($experts);
?>
