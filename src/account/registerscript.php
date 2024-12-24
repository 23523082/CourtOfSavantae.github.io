<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../dbconnections.php'; // Ensure this file sets up $conn for the connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "Form submitted.<br>";

    // Collect form data
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $type = $_POST['type'];

    // Validate input
    if (empty($username) || empty($password) || empty($type)) {
        echo "<script>alert('All fields are required. Please fill out the form completely.');</script>";
        exit;
    }

    // Check if username exists
    $checkUsernameSQL = "SELECT username_input FROM login WHERE username_input = ?";
    if ($checkStmt = $conn->prepare($checkUsernameSQL)) {
        echo "Username check query prepared successfully.<br>";
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            echo "<script>alert('This username is already registered.');</script>";
            $checkStmt->close();
            exit;
        }
        echo "Username is not registered. Proceeding.<br>";
        $checkStmt->close();
    } else {
        die("Error preparing username check query: " . $conn->error);
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    echo "Password hashed successfully.<br>";

    // Insert into database
    $sql = "INSERT INTO login (username_input, password_input, type) VALUES (?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        echo "Insert query prepared successfully.<br>";
        $stmt->bind_param("sss", $username, $hashedPassword, $type);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Sign-up successful! Welcome, $username!');
                    window.location.href = 'login.php'; // Redirect to login page
                  </script>";
            exit;
        } else {
            die("Error executing insert query: " . $stmt->error);
        }
    } else {
        die("Error preparing insert query: " . $conn->error);
    }
}
?>
