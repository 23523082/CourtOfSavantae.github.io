<?php
session_start();
require '../dbconnections.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $username_input = trim($_POST['username']);
    $password = trim($_POST['password']);

   
    if (empty($username_input) || empty($password)) {
        echo "<script>alert('Please fill in both fields');</script>";
        exit;
    }

    
    $stmt = $conn->prepare("SELECT * FROM login WHERE username = ?");
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
       
        $user = $result->fetch_assoc(); 

        
        if (password_verify($password, $user['password'])) {
           
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username']; 
            $_SESSION['type'] = $user['type']; 
            

            
            if ($user['type'] === 'admin') {
                header("Location: ../adminPage/adminDashboard.php");
                exit;
            } else {
                header("Location: ../index.php");
                exit;
            }
        } else {
            
            echo "<script>alert('Invalid password');</script>";
        }
    } else {
       
        echo "<script>alert('User not found');</script>";
    }

    $stmt->close();
}

$conn->close();
?>
