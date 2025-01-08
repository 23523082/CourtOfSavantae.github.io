<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || $_SESSION['type'] != 'admin') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="adminstyle.css">
    <script src="adminjs.js" defer></script>
</head>
<body>

<div class="overlay"></div>

<header>
    <h1>Admin Dashboard</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../logout.php">Logout</a></li>
            <li><a href="../editArticle.php">Manage Article</a></li>
            <li><a href="#" id="disable-video" onclick="toggleVideo()">Disable Video</a></li>
            <li><a href="#" id="enable-video" style="display: none;" onclick="toggleVideo()">Enable Video</a></li>
        </ul>
    </nav>
</header>

<audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>
<div class="video-background">
    <video autoplay loop muted id="background-video">
        <source src="../account/source/background.mp4" type="video/mp4">
    </video>
</div>

<div class="container">
    
    <section class="right">
    <h2>Existing Articles</h2>
    <div class="container">
        <ul class="article-list">
        <?php
        require '../dbconnections.php';

        
        $sql = "SELECT content.id, content.title, content.date, login.username AS maker 
                FROM content 
                JOIN login ON content.maker = login.id 
                ORDER BY content.date DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            echo "<li class='article-item'>";
            echo "<p><strong>Title:</strong> " . htmlspecialchars($row['title']) . "</p>";
            echo "<p><strong>Date:</strong> " . htmlspecialchars($row['date']) . "</p>";
            echo "<p><strong>Maker:</strong> " . htmlspecialchars($row['maker']) . "</p>";
            echo "<p><a href='../articleview/article.php?id=" . htmlspecialchars($row['id']) . "'>View Article</a></p>";
            echo "<form class='user-action-form' method='POST' action='deleteArticle.php'>";
            echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
            echo "<button type='submit' name='action' value='delete' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</button>";
            echo "</form>";
            echo "</li>";
        }
        ?>
        </ul>
    </div>
    </section>
</div>

<footer>
    <p>&copy; 2023 My Blog. All rights reserved.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="adminjs.js"></script>

</body>
</html>
