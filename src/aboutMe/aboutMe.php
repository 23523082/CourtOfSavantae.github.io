<?php 
session_start();
require '../dbconnections.php';

if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || !isset($_SESSION['type'])){
    header("Location: account/login.php");
    exit;
}

$userId = $_SESSION['id'];
$sql = "SELECT username FROM login WHERE id = ?";
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
    <title>About Me</title>
    <link rel="stylesheet" href="aboutStyle.css">
    <script src="about.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>About Me</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../newArticle/NewArticle.php">Create Article</a></li>
                    <li><a href="../logout.php">Logout</a></li>
                    <li><a href="#" id="disable-video" onclick="toggleVideo()">Disable Video</a></li>
                    <li><a href="#" id="enable-video" style="display: none;" onclick="toggleVideo()">Enable Video</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="video-background">
        <video autoplay loop muted id="background-video">
            <source src="../account/source/background.mp4" type="video/mp4">
        </video>
    </div>
    <audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>

    <div class="overlay"></div>

    <div class="container about-page">
        <section class="left">
            <img src="../image source/aboutmepic.jpg" alt="Profile Picture" class="profile-picture">
            <h2><?php echo htmlspecialchars($userData['username']); ?></h2>
            <p>Hi, I'm <?php echo htmlspecialchars($userData['username']); ?>. Click on the buttons below to learn more about me!</p>
            <div class="buttons">
                <button onclick="showContent('whoAmI')">Who Am I?</button>
                <button onclick="showContent('myHobby')">My Hobby</button>
                <button onclick="showContent('whyThisTheme')">Why This Theme?</button>
            </div>
        </section>
        <section class="right">
            <h2 id="content-title">Welcome</h2>
            <p id="content-description">Click on the buttons on the left to learn more about me!</p>
        </section>
    </div>

    <footer>
        <p>&copy; 2023 My Blog. All rights reserved.</p>
    </footer>

</body>
</html>
