<?php 
session_start();
require '../dbconnections.php';
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || !isset($_SESSION['type'])){
    header("Location: account/login.php");
    exit;
}

$userId = $_SESSION['id'];
$sql = "SELECT id, username, type FROM login WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="NewArticleStyle.css">
    <title>Create New Article</title>
</head>
<body>

<header>
    <div class="container">
    </div>
    <nav>
        <ul>
            <li><a href="MyfirstWebPage.HTML">My first Html</a></li>
            <li><a href="#about">About Me</a></li>
            <li><a href="../index.php">Home</a></li>
            <li><a href="#" id="disable-video" onclick="toggleVideo()">Disable Video</a></li>
            <li><a href="#" id="enable-video" style="display: none;" onclick="toggleVideo()">Enable Video</a></li>
        </ul>
    </nav>
</header>

<div class="video-background">
    <video autoplay loop muted id="background-video">
        <source src="../account/source/background.mp4" type="video/mp4">
    </video>
</div>

<div class="overlay"></div>

<div class="container">
    <div class="blog-post">
    <h3 class="center-text">You're currently making an article as: <br><?php echo htmlspecialchars($userData['username']); ?></h3>
        <form action="NewArticleScript.php" method="post" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="image">Upload Image (jpg, png, gif, MAX 50MB):</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="paragraph">Paragraph:</label>
            <textarea id="paragraph" name="paragraph" required></textarea>

            <label for="linkyt">YouTube Video Link:</label>
            <input type="text" id="linkyt" name="linkyt" placeholder="Enter YouTube video ID">

            <input type="submit" value="Submit Article">
        </form>
    </div>
</div>

<audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>

<footer>
    <p>&copy; 2023 My Blog. All rights reserved.</p>
</footer>

<!-- Link to external JS file -->
<script src="newArticejs.js"></script>

</body>
</html>
