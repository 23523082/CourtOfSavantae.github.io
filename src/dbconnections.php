<?php

$servername = "localhost"; 
$username = "Vibe";        
$password = null;             
$dbname = "article";           


$conn = new mysqli($servername, $username, $password, $dbname,);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

