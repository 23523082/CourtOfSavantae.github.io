<?php 
session_start();
require '../dbconnections.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="logins.css">
</hea>

<body>
    <!-- Video Background -->
    <div class="video-background">
        <video autoplay loop muted>
            <source src="source/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Overlay to Darken Background -->
    <div class="overlay"></div>

    <!-- Content Area -->
    <header>
        <h1>Welcome, Rover.</h1>
    </header>

    <main>
        <h2>Login to continue.</h2>
        <form action="Loginscript.php" method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" re quired>
            </div>
            <div>
                <button type="submit">Login</button>
                <p>no acccount ? <a href="register.php">Register</a></p>
            </div>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 My Blog. All rights reserved.</p>
    </footer>

    <!-- Audio File -->
    <audio id="audio-player" src="source/background.mp3" loop></audio>

    <!-- JavaScript to Handle Audio Play -->
    <script>
        document.addEventListener('click', musicPlay);

        function musicPlay() {
            // Play the audio when the user clicks anywhere on the page
            document.getElementById('audio-player').play();
            // Remove the event listener after the audio starts playing to prevent it from being triggered multiple times
            document.removeEventListener('click', musicPlay);
        }
    </script>

</body>

</html>
