<?php
// process_login.php
session_start();
require '../dbconnections.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username_input = trim($_POST['username']);
    $password_input = $_POST['password'];

    // Prepare the SQL statement to fetch user details
    $stmt = $conn->prepare("SELECT id, username_input, password_input, type FROM login WHERE username_input = ? LIMIT 1");
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify the password (assuming it's hashed)
        if (password_verify($password_input, $user['password_input'])) {
            // Start session and store user info
            session_start();
            $_SESSION['username'] = $user['username_input'];
            $_SESSION['user_id'] = $user['id']; // Store user ID for further use
            $_SESSION['user_type'] = $user['type']; // Store user type

            // Redirect based on user type
            if ($user['type'] === 'admin') {
                header("Location: blog/adminPage/adminDashboard.php");
            } else {
                header("Location: ../index.php"); // Redirect for non-admin users
            }
            exit();
        } else {
            // Incorrect password
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        // User not found
        echo "<script>alert('No user found with that username.');</script>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
