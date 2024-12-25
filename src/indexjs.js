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

    if (videoState === "disabled") {
        document.getElementById("background-video").style.display = "none";  // Hide video
        document.getElementById("disable-video").style.display = "none";     // Hide disable button
        document.getElementById("enable-video").style.display = "inline";    // Show enable button
    } else {
        document.getElementById("background-video").style.display = "block"; // Show video
        document.getElementById("disable-video").style.display = "inline";   // Show disable button
        document.getElementById("enable-video").style.display = "none";      // Hide enable button
    }
};

const audioPlayer = document.getElementById('audio-player');

        // Resume audio playback if it was playing before
        window.addEventListener('load', function () {
            if (sessionStorage.getItem('audioPlaying') === 'true') {
                audioPlayer.play();
            }
        });

        document.addEventListener('click', function musicPlay() {
            document.getElementById('audio-player').play();
            document.removeEventListener('click', musicPlay); // Remove listener to prevent multiple triggers
        });