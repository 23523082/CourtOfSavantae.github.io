<?php 
session_start(); // Ensure the session is started to get logged-in user's data

// Check if the user is logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: account/login.php");
    exit;
}
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
        <h1>My Blog</h1>
    </div>
    <nav>
        <ul>
            <li><a href="MyfirstWebPage.HTML">My first Html</a></li>
            <li><a href="#about">About Me</a></li>
            <li><a href="NewArticle.php">Create Article</a></li>
            <li><a href="index.php">Home</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    <div class="blog-post">
        <h2>Create New Article</h2>
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

<footer>
    <p>&copy; 2023 My Blog. All rights reserved.</p>
</footer>

</body>
</html>
