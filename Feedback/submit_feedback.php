<?php
// Database connection settings
$host = "localhost";
$username = "root";
$password = "";
$database = "EmpowerHerBangladesh2";

// Create a new database connection
$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = $_POST['rating'];
    $opinion = $_POST['opinion'];

    // Perform data validation if needed

    // Insert data into the database
    $sql = "INSERT INTO feedback (rating, opinion) VALUES ('$rating', '$opinion')";

    if (mysqli_query($connection, $sql)) {
        echo "Feedback submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
}
?>

