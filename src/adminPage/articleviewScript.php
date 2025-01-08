<?php
$articleId = $_GET['id'];


$pdo = new PDO('mysql:host=localhost;dbname=article', 'Vibe', null);


$stmt = $pdo->prepare('
    SELECT 
        queryarticle.image, 
        queryarticle.paragraph1,     
        queryarticle.title, 
        queryarticle.linkyt, 
        queryarticle.date, 
        queryarticle.maker,
        login.username
    FROM queryarticle
    INNER JOIN login ON queryarticle.maker = login.id
    WHERE queryarticle.id = ?'
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
