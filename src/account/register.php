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
        </video>
    </div>

    <!-- Overlay to Darken Background -->
    <div class="overlay"></div>

    <!-- Content Area -->
    <header>
        <img src="./source/Huanglong_Emblem.jpg" alt="Logo">
    </header>

    <main>
        <form id="registerForm" action="registerscript.php" method="POST" onsubmit="startTransition(event)">
            <div>
                <label for="username">Username:</label>
                <input type="username" name="username" required>
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
    </footer>

    <!-- Transition Overlay -->
    <div id="transition-overlay"></div>

    <!-- Audio File -->
    <audio id="audio-player" src="https://dl.dropboxusercontent.com/scl/fi/ga9ralp47heq4k1deecmh/Luna-Fake-Ascension-OST-Menu-BGM-Looped-Punishing-Gray-Raven.mp3?rlkey=nz5hcls348s8snq26zfjpe4y6&st=0j906q7l" loop></audio>
    <audio id="submit-audio" src="source/click.mp3"></audio>


    <!-- JavaScript to Handle Audio Play -->
    <script>
        // Play background music on user interaction
        document.addEventListener('click', function musicPlay() {
            document.getElementById('audio-player').play();
            document.removeEventListener('click', musicPlay); // Remove listener to prevent multiple triggers
        });

        // Transition and form submission handling
        function startTransition(event) {
            event.preventDefault(); // Prevent immediate form submission
            const overlay = document.getElementById('transition-overlay');
            overlay.style.display = 'block'; // Show the overlay
            overlay.classList.add('active'); // Trigger animation

            document.getElementById('submit-audio').play();

            setTimeout(() => {
                document.getElementById('registerForm').submit(); // Submit the form programmatically
            }, 1000); // Delay matches animation duration
        }
    </script>
</body>

</html>
