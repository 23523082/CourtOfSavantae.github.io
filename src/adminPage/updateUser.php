<?php
require '../dbconnections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['id']);
    $username = $_POST['username'];
    $type = $_POST['type'];

    // Validate input
    if (empty($username) || empty($type)) {
        die("All fields are required.");
    }

    // Update user data
    $sql = "UPDATE login SET username = ?, type = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("ssi", $username, $type, $user_id);

    if ($stmt->execute()) {
        header("Location: adminDashboard.php"); // Redirect after successful update
        exit;
    } else {
        die("Error updating user: " . $conn->error);
    }
} else {
    die("Invalid request method.");
}
?>
