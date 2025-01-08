<?php
session_start(); 

require 'dbconnections.php'; 


if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['type'])) {
    $userId = $_SESSION['id']; 
    $sql = "SELECT id, username, type FROM login WHERE id = ?";
    
    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $userId); 
        $stmt->execute(); 

        
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc(); 
            echo json_encode($userData);
        } else {
            echo json_encode(["error" => "User not found."]);
        }

        
        $stmt->close();
    } else {
        echo json_encode(["error" => "Database query failed."]);
    }
} else {
    echo json_encode(["error" => "User not logged in."]);
}

$conn->close(); 
