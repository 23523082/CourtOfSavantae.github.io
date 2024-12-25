<?php
$articleId = $_GET['id'];

// Create a new PDO instance to connect to the database
$pdo = new PDO('mysql:host=localhost;dbname=article', 'Vibe', null);

// Prepare the SQL statement to fetch article details along with the username of the maker
$stmt = $pdo->prepare('
    SELECT 
        content.image, 
        content.paragraph1,     
        content.title, 
        content.linkyt, 
        content.date, 
        content.maker,
        login.username
    FROM content
    INNER JOIN login ON content.maker = login.id
    WHERE content.id = ?'
);

// Execute the query with the article ID
$stmt->execute([$articleId]);

// Fetch the result as an associative array
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if ($article) {
    // Extract article details from the result
    $image = $article['image'];
    $paragraph1 = $article['paragraph1'];
    $date = $article['date'];
    $title = $article['title'];
    $linkyt = $article['linkyt'];
    $maker = $article['username']; // Get the username from the maker's ID
} else {
    // Handle the case when the article doesn't exist
    $image = "";
    $paragraph1 = "Sorry, the article you're looking for doesn't exist.";
    $date = "";
    $title = "";
    $maker = ""; // Set maker to an empty string when the article is not found
}
?>
