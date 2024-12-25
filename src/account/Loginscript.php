<?php
session_start();
require '../dbconnections.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Clean the input values
    $username_input = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if username and password are not empty
    if (empty($username_input) || empty($password)) {
        echo "<script>alert('Please fill in both fields');</script>";
        exit;
    }

    // Prepare SQL statement to select the user
    $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user data
        $user = $result->fetch_assoc(); 

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username']; // Storing the username
            $_SESSION['type'] = $user['type']; // Storing the user type (admin, maker, reader)

            // Debug: Check session variables
            // echo 'Session ID: ' . $_SESSION['id'] . ', Username: ' . $_SESSION['username'] . ', User Type: ' . $_SESSION['type'];

            // Redirect based on user type
            if ($user['type'] === 'admin') {
                header("Location: ../adminPage/adminDashboard.php");
                exit;
            } else {
                header("Location: ../index.php");
                exit;
            }
        } else {
            // If the password is incorrect
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
        // If the user is not found
        echo "<script>alert('User not found');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
