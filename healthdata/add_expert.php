<?php
// Include your database connection code here (e.g., db_connection.php)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get expert data from the POST request
    $name = $_POST['name'];
    $category = $_POST['category'];
    $education = $_POST['education'];
    $contact = $_POST['contact'];
    $recommendation = $_POST['recommendation'];
    $picture = $_POST['picture'];

    // Insert the expert into the database
    $sql = "INSERT INTO Experts (name, category, education, contact, recommendation, picture) 
            VALUES ('$name', '$category', '$education', '$contact', '$recommendation', '$picture')";

    // Execute the SQL query
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array('success' => true));
    } else {
        echo json_encode(array('success' => false, 'error' => mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
