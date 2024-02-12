<?php
// Define your database connection details
$hostname = 'localhost'; // e.g., 'localhost'
$username = 'root';
$password = '';
$database = 'tasniakibriya';

// Create a database connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the question input field is set in the POST request
    if (isset($_POST['question'])) {
        // Get the submitted question
        $question = $_POST['question'];

        // Define an SQL query to insert the question into the database
        $sql = "INSERT INTO questions (question_text) VALUES (?)";

        // Prepare the SQL statement
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            // Bind the question parameter
            $stmt->bind_param('s', $question);

            // Execute the query
            if ($stmt->execute()) {
                // Send a response (you can customize the response as needed)
                echo 'Question submitted successfully!';
            } else {
                echo 'Error: Could not save the question.';
            }
        } else {
            echo 'Error: Could not prepare the statement.';
        }
    } else {
        // Question input field not found in POST request
        echo 'Error: Question not provided.';
    }
} else {
    // Handle non-POST requests (optional)
    echo 'Invalid request method.';
}

// Close the database connection
$connection->close();
?>
