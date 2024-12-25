<?php
session_start(); // Start the session to access session variables

require 'dbconnections.php'; // Include your DB connection

// Check if the user is logged in (using session variables)
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['type'])) {
    $userId = $_SESSION['id']; // Get the logged-in user's ID from the session
    $sql = "SELECT id, username, type FROM login WHERE id = ?";
    
    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId); // Bind the user ID parameter
        $stmt->execute(); // Execute the query

        // Get the result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc(); // Fetch the user's data
            // Return the user data as an associative array
            echo json_encode($userData);
        } else {
            echo json_encode(["error" => "User not found."]);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(["error" => "Database query failed."]);
    }
} else {
    echo json_encode(["error" => "User not logged in."]);
}

$conn->close(); // Close the database connection
?>
