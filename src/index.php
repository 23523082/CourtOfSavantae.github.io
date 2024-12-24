<?php 
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username_input'])|| !isset($_SESSION['type'])){
    header("Location: account/login.php");
    exit;
  }

  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>My Blog</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="MyfirstWebPage.HTML">My first Html</a></li>
                    <li><a href="#about">About Me</a></li>
                    <li><a href="NewArticle.php">Create Article</a></li>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container "  >
        <section id="main">
            <?php
            require 'dbconnections.php';
            $sql = "SELECT id, title, date, paragraph1 FROM content ORDER BY date DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<article class="blog-post">';
                    echo '<h2>' . $row["title"] . '</h2>';
                    echo '<small>Posted on ' . $row["date"] . '</small>';
                    echo '<p>' . substr($row["paragraph1"], 0, 100) . '...</p>'; 
                    echo '<a href="article.php?id='. $row["id"].'">Read More</a>';
                    echo '</article>';
                }
            } else {
                echo "<p>No articles found.</p>";
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
