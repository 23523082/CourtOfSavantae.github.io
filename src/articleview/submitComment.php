<?php
session_start();
if (!isset($_SESSION['id']) || !isset($_POST['article_id']) || !isset($_POST['comment_text'])) {
    header("Location: article_page.php?error=invalid_request");
    exit;
}

require '../dbconnections.php';

$article_id = intval($_POST['article_id']);
$user_id = intval($_SESSION['id']); // Current user's ID
$comment_text = trim($_POST['comment_text']);

if (empty($comment_text)) {
    header("Location: article.php?id=$article_id");
    exit;
}

$sql = "INSERT INTO comments (article_id, user_id, comment_text) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $article_id, $user_id, $comment_text);

if ($stmt->execute()) {
    // Refresh the page without any additional messages
    header("Location: article.php?id=$article_id");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
