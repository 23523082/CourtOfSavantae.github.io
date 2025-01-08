<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require '../dbconnections.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    

    $password = $_POST['password'];
    $username = $_POST['username'];
    $type = $_POST['type'];

   
    if (empty($username) || empty($password)|| empty($type)) {
        echo "<script>alert('All fields are required. Please fill out the form completely.');</script>";
        exit;
    }

        
        $checkEmailSQL = "SELECT username FROM login WHERE username = ?";
        if ($checkStmt = $conn->prepare($checkEmailSQL)) {
            echo "Email check query prepared successfully.<br>";
            $checkStmt->bind_param("s", $username);
            $checkStmt->execute();
            $checkStmt->store_result();

            if ($checkStmt->num_rows > 0) {
                echo "<script>alert('This username is already registered.');</script>";
                $checkStmt->close();
                exit;
            }
            echo "username is not registered. Proceeding.<br>";
            $checkStmt->close();
        } else {
            die("Error preparing username check query: " . $conn->error);
        }

        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo "Password hashed successfully.<br>";

        
        $sql = "INSERT INTO  login  (username, password, type)
                VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            echo "Insert query prepared successfully.<br>";
            $stmt->bind_param("sss", $username, $hashedPassword, $type);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Sign-up successful! Welcome, $username!');
                        window.location.href = 'login.php'; // Redirect to home page
                      </script>";
                exit;
            } else {
                die("Error executing insert query: " . $stmt->error);
            }
        } else {
            die("Error preparing insert query: " . $conn->error);
        }
   
    }


