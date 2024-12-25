<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || $_SESSION['type'] != 'admin') {
    header("Location: ../account/login.php");
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
    <!-- Left section for user management -->
    <section class="left">
        <h2>Registered Users</h2>
        <ul class="user-list">
            <?php
            // Include database connection
            require '../dbconnections.php';
            $sql = "SELECT id, username, type FROM login";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "Username: " . htmlspecialchars($row['username']);
                echo "<P></p>";
                echo "Type: ". htmlspecialchars($row['type']);
                echo "<br></br>";
                echo "<button class='change-type'>Change Type</button>";
                echo "<button>Delete</button>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>

    <!-- Right section for article review -->
    <section class="right">
    <h2>Articles Waiting for Review</h2>
    <ul class="article-list">
        <?php
        // Query for articles awaiting review, no status column
        $sql = "SELECT id, title, image, paragraph1, ytlink, maker FROM queryarticle";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "ID: " . htmlspecialchars($row['id']) . "<br>";
            echo "Title: " . htmlspecialchars($row['title']) . "<br>";
            echo "Maker ID: " . htmlspecialchars($row['maker']) . "<br>";
            echo "Image: <img src='../uploads/" . htmlspecialchars($row['image']) . "' alt='Image' width='100'><br>";
            echo "Paragraph: " . htmlspecialchars($row['paragraph1']) . "<br>";
            if ($row['ytlink']) {
                echo "YouTube Link: <a href='https://www.youtube.com/watch?v=" . htmlspecialchars($row['ytlink']) . "' target='_blank'>Watch</a><br>";
            }
            echo "<button class='accept-article'>Accept</button>";
            echo "<button>Reject</button>";
            echo "</li>";
        }
        ?>
    </ul>
</section>


</div>



<footer>
    <p>&copy; 2023 My Blog. All rights reserved.</p>
</footer>

</body>
</html>
