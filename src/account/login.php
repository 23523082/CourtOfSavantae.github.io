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
    <link rel="stylesheet" href="register.css">
</hea>

<body>
    <!-- Video Background -->
    <div class="video-background">
        <video autoplay loop muted>
            <source src="source/background.mp4" type="video/mp4">
        </video>
    </div>

    <!-- Overlay to Darken Background -->
    <div class="overlay"></div>

    <!-- Content Area -->
    <header>
        <image src="./source/Huanglong_Emblem.jpg"></image>
    </header>

    <main>
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
                <button type="submit" onclick="playSubmitAudio()">Login</button>
                <p>no acccount ? <a href="register.php">Register</a></p>
            </div>
        </form>
    </main>

        

    <!-- Audio File -->
    <audio id="audio-player" src="source/background.mp3" loop></audio>
    <audio id="submit-audio" src="source/click.mp3"></audio>

    <!-- JavaScript to Handle Audio Play -->
    <script>
        document.addEventListener('click', musicPlay);

        function musicPlay() {
            // Play the audio when the user clicks anywhere on the page
            document.getElementById('audio-player').play();
            // Remove the event listener after the audio starts playing to prevent it from being triggered multiple times
            document.removeEventListener('click', musicPlay);
        }
        function playSubmitAudio() {
        // Play the audio when the submit button is clicked
        document.getElementById('submit-audio').play();
    }
    </script>

</body>

</html>
