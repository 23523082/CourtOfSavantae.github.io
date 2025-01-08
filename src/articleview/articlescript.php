<?php
$articleId = $_GET['id'];


$pdo = new PDO('mysql:host=localhost;dbname=article', 'Vibe', null);


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


$stmt->execute([$articleId]);


$article = $stmt->fetch(PDO::FETCH_ASSOC);

if ($article) {
    
    $image = $article['image'];
    $paragraph1 = $article['paragraph1'];
    $date = $article['date'];
    $title = $article['title'];
    $linkyt = $article['linkyt'];
    $maker = $article['username']; 
} else {
   
    $image = "";
    $paragraph1 = "Sorry, the article you're looking for doesn't exist.";
    $date = "";
    $title = "";
    $maker = ""; // Set maker to an empty string when the article is not foun
}

