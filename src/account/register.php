<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>

<body>
    <!-- Video Background -->
    <div class="video-background">
        <video autoplay loop muted>
            <source src="./source/background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <!-- Overlay to Darken Background -->
    <div class="overlay"></div>

    <!-- Content Area -->
    <header>
        <h1>Welcome to Solaris-3.</h1>
    </header>

    <main>
        <h2>"I exist because of you."<br><i>Shorekeeper</i></br></h2>
        <form action="registerscript.php" method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div>
                <label for="type">Account Type:</label>
                <select id="type" name="type" required>
                    <option value="">Select Account Type</option>
                    <option value="reader">Reader</option>
                    <option value="maker">Article Maker</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 My Blog. All rights reserved.</p>
        <p>Made by Lunetta Maheswara Grahawijaya</p>
        <img src="" alt="">
    </footer>

    <!-- Audio File -->
    <audio id="audio-player" src="./source/background.mp3" loop></audio>

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
