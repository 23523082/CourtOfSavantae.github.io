<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || !isset($_SESSION['type'])){
    header("Location: account/login.php");
    exit;
}
require '../dbconnections.php';  
require 'articlescript.php'; 
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
    <title>Court of Savantae</title>
    <link rel="stylesheet" href="../articleview/contentstyle.css">
    <script src="../articleview/articlejs.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="myfirstweb/MyfirstWebPage.HTML">My first Html</a></li>
                    <li><a href="aboutMe/aboutMe.php">About Me</a></li>
                    <li><a href="newArticle/NewArticle.php">Create Article</a></li>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="#" id="disable-video" onclick="toggleVideo()">Disable Video</a></li>
                    <li><a href="#" id="enable-video" style="display: none;" onclick="toggleVideo()">Enable Video</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="overlay"></div>
    <audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>
    <div class="video-background">
        <video autoplay loop muted id="background-video">
            <source src="../account/source/background.mp4" type="video/mp4">
        </video>
    </div>



    <div class="container">
        <article class="article">
            <h1><?php echo htmlspecialchars($title); ?></h1>
            <div class="meta">
                <small>Posted on: <?php echo htmlspecialchars($date); ?></small>
                <p></p>
                <small>By: <?php echo htmlspecialchars($maker); ?></small>
            </div>
            <?php if (!empty($image)) : ?>
                <img src="../uploads/<?php echo htmlspecialchars($image); ?>" />
            <?php endif; ?>
            <p><?php echo htmlspecialchars($paragraph1); ?></p>
            <?php if (!empty($linkyt)) : ?>
                <div class="video-responsive">
                    <iframe 
                        id="yt-video"
                        src="https://www.youtube.com/embed/<?php echo htmlspecialchars($linkyt); ?>" 
                        title="YouTube video player" 
                        frameborder="0" 
                        allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        allowfullscreen>
                    </iframe>
                </div>
            <?php endif; ?>
        </article>
    </div>

    <footer>
        <p>&copy; 2023 My Blog. All rights reserved.</p>
    </footer>
</body>
</html>
