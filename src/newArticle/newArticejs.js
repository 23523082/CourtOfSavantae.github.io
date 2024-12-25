// Function to toggle video state
function toggleVideo() {
    var video = document.getElementById("background-video");
    var disableButton = document.getElementById("disable-video");
    var enableButton = document.getElementById("enable-video");

    // If video is hidden, show it and toggle buttons
    if (video.style.display === "none") {
        video.style.display = "block";   // Show video
        disableButton.style.display = "none";  // Hide disable button
        enableButton.style.display = "inline"; // Show enable button
        sessionStorage.setItem("videoState", "enabled"); // Store video state
    } else {
        video.style.display = "none";    // Hide video
        disableButton.style.display = "inline"; // Show disable button
        enableButton.style.display = "none";    // Hide enable button
        sessionStorage.setItem("videoState", "disabled"); // Store video state
    }
}

window.onload = function() {
    // Check if the video state is stored in sessionStorage
    var videoState = sessionStorage.getItem("videoState");
    var video = document.getElementById("background-video");
    var disableButton = document.getElementById("disable-video");
    var enableButton = document.getElementById("enable-video");

    if (videoState === "disabled") {
        video.style.display = "none";  // Hide video
        disableButton.style.display = "none";     // Hide disable button
        enableButton.style.display = "inline";    // Show enable button
    } else {
        video.style.display = "block"; // Show video
        disableButton.style.display = "inline";   // Show disable button
        enableButton.style.display = "none";      // Hide enable button
    }

    // Check if the audio state is stored in sessionStorage
    var audioState = sessionStorage.getItem('audioPlaying');
    const audioPlayer = document.getElementById('audio-player');

    if (audioState === 'true') {
        audioPlayer.play();
    }

    // Automatically start audio playback on any click if it's not already playing
    document.addEventListener('click', function musicPlay() {
        if (audioPlayer.paused) {
            audioPlayer.play();
            sessionStorage.setItem('audioPlaying', 'true'); // Store that audio is playing
        }
        document.removeEventListener('click', musicPlay); // Remove listener to prevent multiple triggers
    });
};
