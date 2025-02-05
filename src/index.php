<?php 
session_start();
require 'dbconnections.php';
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
    <title>Court Of Savantae</title>
    <link rel="stylesheet" href="indexStyle.css">
    <script src="indexjs.js" defer></script>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Welcome, <?php echo htmlspecialchars($userData['username'])?>.</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="myfirstweb/MyfirstWebPage.HTML">My first Html</a></li>
                    <li><a href="aboutMe/aboutMe.php">About Me</a></li>
                    <li><a href="newArticle/NewArticle.php">Create Article</a></li>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="adminPage/adminDashboard.php">Admin</a></li>
                    <li><a href="#" id="disable-video" onclick="toggleVideo()">Disable Video</a></li>
                    <li><a href="#" id="enable-video" style="display: none;" onclick="toggleVideo()">Enable Video</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="video-background">
        <video autoplay loop muted id="background-video">
            <source src="account/source/background.mp4" type="video/mp4">
        </video>
    </div>
    <audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>

    <div class="overlay"></div>

    <div class="container">
        <section id="main">
            <?php
            require 'dbconnections.php';
            $sql = "SELECT content.id, content.title, content.date, content.paragraph1, login.username AS maker
                    FROM content
                    JOIN login ON content.maker = login.id
                    ORDER BY content.date DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<article class="blog-post">';
                    echo '<h2>' . $row["title"] . '</h2>';
                    echo '<h3>made by : ' . $row["maker"] . '</h3>';
                    echo '<small>Posted on ' . $row["date"] . '</small>';
                    echo '<p>' . substr($row["paragraph1"], 0, 100) . '...</p>'; 
                    echo '<a href="articleview/article.php?id='. $row["id"].'">Read More</a>';
                    echo '</article>';
                }
            } else {
                echo "<p>No articles found, maybe try adding some!</p>";
            }

            $conn->close();
            ?>
        </section>
    </div>

    <footer>
        <p>&copy; 2023 My Blog. All rights reserved.</p>
    </footer>
</body>
</html>
