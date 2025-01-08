<?php
require '../dbconnections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id']) && isset($_POST['action'])) {
        $id = intval($_POST['id']);
        $action = $_POST['action'];

        if ($action === 'accept') {
           
            $sql_query = "SELECT * FROM queryarticle WHERE id = ?";
            $stmt = $conn->prepare($sql_query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Insert data into the content table
                $sql_insert = "INSERT INTO content (title, image, date, paragraph1, linkyt, maker) 
                               VALUES (?, ?, ?, ?, ?, ?)";  
                $stmt = $conn->prepare($sql_insert);

                if (!$stmt) {
                    echo "Insert SQL Error: " . $conn->error;
                    exit;
                }

                // Bind parameters in the correct order
                $stmt->bind_param(
                    "ssssss", 
                    $row['title'],      
                    $row['image'],      
                    $row['date'],       
                    $row['paragraph1'], 
                    $row['linkyt'],     
                    $row['maker']       
                );

                if ($stmt->execute()) {
                    // Delete from queryarticle if successfully inserted
                    $sql_delete = "DELETE FROM queryarticle WHERE id = ?";
                    $stmt = $conn->prepare($sql_delete);
                    $stmt->bind_param("i", $id);

                    if ($stmt->execute()) {
                        echo "success";
                    } else {
                        echo "Error deleting query: " . $stmt->error;
                    }
                } else {
                    echo "Error inserting into content: " . $stmt->error;
                }
            } else {
                echo "Query not found.";
            }

            $stmt->close();
        } elseif ($action === 'reject') {
            // Delete the rejected query
            $sql_delete = "DELETE FROM queryarticle WHERE id = ?";
            $stmt = $conn->prepare($sql_delete);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                echo "success";
            } else {
                echo "Error rejecting query: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Invalid action.";
        }
    } else {
        echo "Invalid request parameters.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
