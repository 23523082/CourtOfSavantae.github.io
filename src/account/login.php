<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="register.css">
</head>

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
        <img src="./source/Huanglong_Emblem.jpg" alt="Logo">
    </header>

    <main>
        <form id="loginForm" action="Loginscript.php" method="POST" onsubmit="startTransition(event)">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <button type="submit">Login</button>
                <p>No account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </main>

    <!-- Transition Overlay -->
    <div id="transition-overlay"></div>

    <!-- Audio -->
    <audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>
    <audio id="submit-audio" src="source/click.mp3"></audio>

    <!-- JavaScript -->
    <script src="accountjs.js"></script>
</body>

</html>
