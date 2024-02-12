<?php
// Include your database connection code here (e.g., db_connection.php)

if (isset($_GET['expertId'])) {
    $expertId = $_GET['expertId'];

    // Query to retrieve chat messages for the specified expert
    $sql = "SELECT * FROM ChatMessages WHERE expert_id = $expertId ORDER BY timestamp";

    // Execute the SQL query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $chatMessages = array();

        // Fetch and add each chat message to the array
        while ($row = mysqli_fetch_assoc($result)) {
            $chatMessages[] = $row['message'];
        }

        // Close the database connection
        mysqli_close($conn);

        // Return the list of chat messages as JSON
        echo json_encode(array('success' => true, 'messages' => $chatMessages));
    } else {
        echo json_encode(array('success' => false, 'error' => mysqli_error($conn)));
    }
} else {
    echo json_encode(array('success' => false, 'error' => 'Expert ID not provided.'));
}
?>
