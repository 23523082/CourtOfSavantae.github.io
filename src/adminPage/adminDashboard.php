<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username_input'])|| !isset($_SESSION['type'])){
    header("Location: account/login.php");
    exit;
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 20%;
            background-color: #f3f4f6;
            color: #333;
        }
        h1 {
            font-size: 2.5rem;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>
    <p>This is a placeholder page for admin users.</p>
                <ul>
                    <li><a href="../logout.php">Logout</a></li>
                </u>
</body>
</html>
