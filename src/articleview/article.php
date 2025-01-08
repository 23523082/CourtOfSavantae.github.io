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
    <link rel="stylesheet" href="contentstyle.css">
    <script src="articlejs.js" defer></script>
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
                    <li><a href="../logout.php">Logout</a></li>
                    <li><a href="#" id="disable-video" onclick="toggleVideo()">Disable Video</a></li>
                    <li><a href="#" id="enable-video" style="display: none;" onclick="toggleVideo()">Enable Video</a></li>
                </ul>
            </nav>
        </div>
    </header>
            <audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>
             <div class="video-container">
            <video autoplay loop muted>
            <source src="../account/source/background.mp4" type="video/mp4">
            </video>
            <div class="overlay"></div>
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

    <section class="comments-section">
    <h2>Comments</h2>
    <form method="POST" action="submitComment.php">
        <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($articleId); ?>">
        <textarea name="comment_text" rows="4" placeholder="Write your comment here..." required></textarea>
        <button type="submit">Submit Comment</button>
    </form>
    <ul class="comments-list">
        <?php
        // Fetch and display comments for this article
        $stmt = $conn->prepare("
            SELECT c.comment_text, c.created_at, l.username
            FROM comments c
            JOIN login l ON c.user_id = l.id
            WHERE c.article_id = ?
            ORDER BY c.created_at DESC
        ");
        $stmt->bind_param("i", $articleId);
        $stmt->execute();
        $comments = $stmt->get_result();
        while ($comment = $comments->fetch_assoc()) {
            echo "<li>";
            echo "<strong>" . htmlspecialchars($comment['username']) . "</strong> ";
            echo "<small>(" . htmlspecialchars($comment['created_at']) . ")</small>";
            echo "<p>" . htmlspecialchars($comment['comment_text']) . "</p>";
            echo "</li>";
        }
        $stmt->close();
        ?>
    </ul>
</section>

    <footer>
        <p>&copy; 2023 My Blog. All rights reserved.</p>
    </footer>
</body>
</html>
