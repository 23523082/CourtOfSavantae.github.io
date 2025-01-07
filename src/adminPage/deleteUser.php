<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || $_SESSION['type'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

require '../dbconnections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    // Prevent deleting the currently logged-in user
    if ($user_id == $_SESSION['id']) {
        echo "You cannot delete your own account.";
        exit;
    }

    // Delete user from the database
    $sql = "DELETE FROM login WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header("Location: adminDashboard.php");
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
    exit;
}
?>
