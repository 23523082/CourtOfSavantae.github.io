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
            require '../dbconnections.php';
            $sql = "SELECT id, username, type FROM login";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "Username: " . htmlspecialchars($row['username']);
                echo "<p>Type: " . htmlspecialchars($row['type']) . "</p>";
                echo "<form class='user-action-form' method='POST' action='user_actions.php'>";
                echo "<input type='hidden' name='user_id' value='" . htmlspecialchars($row['id']) . "'>";
                echo "<label for='type-change'>Change Type:</label>";
                echo "<select name='new_type' id='type-change'>";
                echo "<option value=''>Select New Type</option>";
                echo "<option value='reader'>Reader</option>";
                echo "<option value='maker'>Maker</option>";
                echo "<option value='admin'>Admin</option>";
                echo "</select>";
                echo "<button type='submit' name='action' value='change_type'>Change Type</button>";
                echo "<button type='submit' name='action' value='delete'>Delete</button>";
                echo "</form>";
                echo "</li>";
            }
            ?>
        </ul>
    </section>

    <!-- Right section for article review -->
    <section class="right">
    <h2>Articles Waiting for Review</h2>
    <div class="container">
        <ul class="article-list">
        <?php
        // Query for articles awaiting review, no status column
        $sql = "SELECT id, title, image, paragraph1, ytlink, maker, date FROM queryarticle";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<li class='article-item'>";
            echo "<p><strong>ID:</strong> " . htmlspecialchars($row['id']) . "</p>";
            echo "<p><strong>Title:</strong> " . htmlspecialchars($row['title']) . "</p>";
            echo "<p><strong>date:</strong> " .  htmlspecialchars($row['date']) . "</p>";
            echo "<p><strong>Maker ID:</strong> " . htmlspecialchars($row['maker']) . "</p>";
            echo "<p><strong>Image:</strong><br> <img src='../uploads/" . htmlspecialchars($row['image']) . "' alt='Image' width='100'></p>";
            echo "<p><strong>Paragraph:</strong> "  . substr($row["paragraph1"], 0, length: 30) .  "......</p>";
            if ($row['ytlink']) {
                echo "<p><strong>YouTube Link:</strong> <a href='https://www.youtube.com/watch?v=" . htmlspecialchars($row['ytlink']) . "' target='_blank'>Watch</a></p>";
            }
            echo "<p>";
            echo "<a href='#' onclick='acceptQuery(" . $row["id"] . ")'>Accept</a> | ";
            echo "<a href='#' onclick='rejectQuery(" . $row["id"] . ")'>Reject</a>";
            echo "</p>";
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
