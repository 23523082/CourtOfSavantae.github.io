<?php
require '../dbconnections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'] ?? null;
    $action = $_POST['action'] ?? null;

    if ($user_id && $action) {
        if ($action === 'delete') {
            // Delete user logic
            $stmt = $conn->prepare("DELETE FROM login WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                echo "User deleted successfully.";
            } else {
                echo "Error deleting user: " . $stmt->error;
            }
            $stmt->close();
        } elseif ($action === 'change_type') {
            // Change user type logic
            $new_type = $_POST['new_type'] ?? null;

            if ($new_type && in_array($new_type, ['reader', 'maker', 'admin'])) {
                $stmt = $conn->prepare("UPDATE login SET type = ? WHERE id = ?");
                $stmt->bind_param("si", $new_type, $user_id);
                if ($stmt->execute()) {
                    echo "User type updated successfully.";
                } else {
                    echo "Error updating user type: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Invalid type selected.";
            }
        } else {
            echo "Invalid action.";
        }
    } else {
        echo "Missing user ID or action.";
    }

    // Redirect back to the page
    header("Location: manage_users.php");
    exit;
}
?>
