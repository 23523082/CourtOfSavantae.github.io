<?php 
session_start(); 
require '../dbconnections.php'; 


if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: account/login.php");
    exit;
}


$username = $_SESSION['username'];
$sql = "SELECT id FROM login WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($maker);
$stmt->fetch();
$stmt->close();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $title = $_POST['title'];
    $date = $_POST['date'];
    $paragraph = $_POST['paragraph'];
    $linkyt = $_POST['linkyt'];

    
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type']; 

    
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; 
    $maxSize = 50 * 1024 * 1024; // 50MB

    
    if ($imageError === 0) {
       
        if (in_array($imageType, $allowedTypes)) {
            
            $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $validExtensions = ['jpeg', 'jpg', 'png', 'gif'];
            
            if (in_array($imageExt, $validExtensions)) {
                
                if ($imageSize <= $maxSize) {
                    
                    $imageNewName = basename($imageName); // Retain original filename
                    $imageDestination = "../uploads/" . $imageNewName;

                    // Check if file already exists and add a suffix to make it unique
                    if (file_exists($imageDestination)) {
                        // Adding a timestamp or unique identifier to avoid overwriting
                        $imageNewName = time() . '_' . $imageNewName;
                        $imageDestination = "../uploads/" . $imageNewName;
                    }

                    // Move the uploaded file to the uploads directory
                    if (move_uploaded_file($imageTmpName, $imageDestination)) {
                        $sql = "INSERT INTO queryarticle (title, image, date, paragraph1, ytlink, maker) VALUES (?, ?, ?, ?, ?, ?)";
                        if ($stmt = $conn->prepare($sql)) {
                            $stmt->bind_param("sssssi", $title, $imageNewName, $date, $paragraph, $linkyt, $maker);
                            $stmt->execute();
                            $stmt->close();
                            header("Location: ../index.php");
                        } else {
                            echo "Error: " . $conn->error;
                        }
                    } else {
                        echo "Error uploading image.";
                    }
                } else {
                    echo "File size exceeds the maximum limit of 50MB.";
                }
            } else {
                echo "Invalid file extension. Allowed extensions are: .jpeg, .jpg, .png, .gif.";
            }
        } else {
            echo "Invalid file type. Only JPG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Error uploading the image.";
    }

    $conn->close(); 
}
?>
