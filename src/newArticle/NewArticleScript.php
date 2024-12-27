<?php 
session_start(); // Start the session to access session variables
require '../dbconnections.php'; // Include your database connection

// Check if the user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: account/login.php");
    exit;
}

// Get the logged-in user's ID based on the username
$username = $_SESSION['username'];
$sql = "SELECT id FROM login WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($maker);
$stmt->fetch();
$stmt->close();

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get form data
    $title = $_POST['title'];
    $date = $_POST['date'];
    $paragraph = $_POST['paragraph'];
    $linkyt = $_POST['linkyt'];

    // Handle the image upload
    $image = $_FILES['image'];
    $imageName = $image['name'];
    $imageTmpName = $image['tmp_name'];
    $imageSize = $image['size'];
    $imageError = $image['error'];
    $imageType = $image['type']; // MIME type provided by the browser

    // Define the allowed file types and max size (50MB)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allow JPEG, PNG, GIF
    $maxSize = 50 * 1024 * 1024; // 50MB

    // Check for errors in the image upload
    if ($imageError === 0) {
        // Check if the file MIME type is allowed
        if (in_array($imageType, $allowedTypes)) {
            // Check file extension (additional check)
            $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $validExtensions = ['jpeg', 'jpg', 'png', 'gif'];
            
            if (in_array($imageExt, $validExtensions)) {
                // Check if the file size is within the limit
                if ($imageSize <= $maxSize) {
                    // Sanitize the original image name to ensure it is safe for the filesystem
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
                        // Prepare the SQL statement to insert the article into the database
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

    $conn->close(); // Close the database connection
}
?>
