const audioPlayer = document.getElementById('audio-player');

    document.addEventListener('click', function musicPlay() {
        // Play the audio
        audioPlayer.play();
        // Save the playback state
        sessionStorage.setItem('audioPlaying', 'true');
        document.removeEventListener('click', musicPlay); // Remove listener to prevent multiple triggers
    });

    // Check if audio should continue playing when the page loads
    window.addEventListener('load', function () {
        if (sessionStorage.getItem('audioPlaying') === 'true') {
            audioPlayer.play(); // Resume playing
        }
    });

    // Transition and submit handling
    function startTransition(event) {
        event.preventDefault(); // Prevent the form from submitting instantly
        // Play submit audio
        document.getElementById('submit-audio').play();

        // Redirect after the animation
        setTimeout(() => {
            document.getElementById('loginForm').submit(); // Submit the form programmatically
        }, 1000); // 1 second delay
    }

    ocument.addEventListener('click', function musicPlay() {
        document.getElementById('audio-player').play();
        document.removeEventListener('click', musicPlay); // Remove listener to prevent multiple triggers
    });