<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $date = $_POST['date'];
    $image = $_POST['image'];
    $paragraph1 = $_POST['paragraph1'];
    $paragraph2 = $_POST['paragraph2'];
    $paragraph3 = $_POST['paragraph3'];
    $paragraph4 = $_POST['paragraph4'];
    $linkyt = $_POST['linkyt'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=article', 'Vibe', null);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO content (title, image, date, paragraph1, paragraph2, paragraph3, paragraph4, linkyt) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $image, $date, $paragraph1, $paragraph2, $paragraph3, $paragraph4, $linkyt]);

        
        $lastId = $pdo->lastInsertId();

        echo "New article created: <a href='article.php?id=$lastId'>View Article</a>";

    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

} else {
    echo "Invalid request.";
}
?>
