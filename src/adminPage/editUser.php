<?php
require '../dbconnections.php';

// Check if the user ID is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("User ID not specified.");
}

$user_id = intval($_GET['id']); // Sanitize input

// Fetch user data from the database
$sql = "SELECT username, type FROM login WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("SQL Error: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="adminstyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="adminjs.js"></script>
</head>

<body>
    <!-- Video Background -->
    <div class="video-background">
        <video autoplay loop muted>
            <source src="../account/source/background.mp4" type="video/mp4">
        </video>
    </div>

    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Main Content -->
    <header>
        <h1>Edit User</h1>
    </header>

    <div class="container">
        <div class="left">
            <form method="POST" action="updateUser.php">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_id); ?>">

                <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>

                <div>
                    <label for="type">Account Type:</label>
                    <select id="type" name="type" required>
                        <option value="reader" <?php echo $user['type'] === 'reader' ? 'selected' : ''; ?>>Reader</option>
                        <option value="maker" <?php echo $user['type'] === 'maker' ? 'selected' : ''; ?>>Article Maker</option>
                        <option value="admin" <?php echo $user['type'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>

                <button type="submit">Update User</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </footer>
</body>

</html>
