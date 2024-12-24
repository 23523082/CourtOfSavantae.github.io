
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
        <form action="NewArticleScript.php" method="post">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="image">dropbox image link, last part of link must be raw=1 </label>
            <textarea id="image" name="image" ></textarea>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" placeholder="YYYY-MM-DD-TT" required>

            <label for="paragraph1">Paragraph 1:</label>
            <textarea id="paragraph1" name="paragraph1" required></textarea>

            <label for="paragraph2">Paragraph 2:</label>
            <textarea id="paragraph2" name="paragraph2"></textarea>

            <label for="paragraph3">Paragraph 3:</label>
            <textarea id="paragraph3" name="paragraph3"></textarea>

            <label for="paragraph4">Paragraph 4:</label>
            <textarea id="paragraph4" name="paragraph4"></textarea>

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
