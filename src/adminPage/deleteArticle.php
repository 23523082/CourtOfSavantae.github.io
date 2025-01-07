<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || $_SESSION['type'] != 'admin') {
    header("Location: ../index.php");
    exit;
}

require '../dbconnections.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $article_id = intval($_POST['id']);

    // Delete article from the content table based on the article ID
    $sql = "DELETE FROM content WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        header("Location: acceptedArticles.php");
    } else {
        echo "Error deleting article: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
    exit;
}
?>
