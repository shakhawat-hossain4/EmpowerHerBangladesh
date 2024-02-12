<?php
// Include your database connection code here (e.g., db_connection.php)

// Query to retrieve all experts
$sql = "SELECT * FROM Experts";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

if ($result) {
    $experts = array();

    // Fetch and add each expert to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $experts[] = $row;
    }

    // Close the database connection
    mysqli_close($conn);

    // Return the list of experts as JSON
    echo json_encode($experts);
} else {
    echo json_encode(array('error' => mysqli_error($conn)));
}
?>

