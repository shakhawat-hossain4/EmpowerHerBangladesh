<?php
// Include your database connection code here (e.g., db_connection.php)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get expert ID and message text from the POST request
    $expertId = $_POST['expertId'];
    $messageText = $_POST['message'];

    // Insert the chat message into the database
    $sql = "INSERT INTO ChatMessages (expert_id, message) 
            VALUES ($expertId, '$messageText')";

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
