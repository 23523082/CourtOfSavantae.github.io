let audioPlayer = document.getElementById('audio-player');
let youtubePlayer;

// YouTube Player API callback to initialize the player
function onYouTubeIframeAPIReady() {
    youtubePlayer = new YT.Player('yt-video', {
        events: {
            'onStateChange': onPlayerStateChange
        }
    });
}

// Detect state changes (play/pause) of the YouTube player
function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.PLAYING) {
        // Mute background audio when YouTube video plays
        audioPlayer.muted = true;
        sessionStorage.setItem('audioMuted', 'true'); // Store that the audio was muted
    } else if (event.data === YT.PlayerState.PAUSED) {
        // Unmute background audio when YouTube video is paused
        audioPlayer.muted = false;
        sessionStorage.setItem('audioMuted', 'false'); // Store that the audio is unmuted
    }
}

// Toggle background video visibility
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

// Load video and audio states from sessionStorage and adjust UI accordingly
window.onload = function () {
    var videoState = sessionStorage.getItem("videoState");

    if (videoState === "disabled") {
        document.getElementById("background-video").style.display = "none";  // Hide video
        document.getElementById("disable-video").style.display = "none";     // Hide disable button
        document.getElementById("enable-video").style.display = "inline";    // Show enable button
    } else {
        document.getElementById("background-video").style.display = "block"; // Show video
        document.getElementById("disable-video").style.display = "inline";   // Show disable button
        document.getElementById("enable-video").style.display = "none";      // Hide enable button
    }

    // Check if the audio is muted, based on session storage
    if (sessionStorage.getItem('audioMuted') === 'true') {
        audioPlayer.muted = true;
    } else {
        audioPlayer.muted = false;
    }

    // Check if the audio is playing, based on session storage
    if (sessionStorage.getItem('audioPlaying') === 'true') {
        audioPlayer.play();
    }
};

// Listen for a click to start the audio (for browsers that block autoplay)
document.addEventListener('click', function musicPlay() {
    audioPlayer.play();
    document.removeEventListener('click', musicPlay); // Remove listener to prevent multiple triggers
});
