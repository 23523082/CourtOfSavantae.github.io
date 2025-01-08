
function toggleVideo() {
    var video = document.getElementById("background-video");
    var disableButton = document.getElementById("disable-video");
    var enableButton = document.getElementById("enable-video");

    if (video.style.display === "none") {
        video.style.display = "block";
        disableButton.style.display = "none";
        enableButton.style.display = "inline";
        sessionStorage.setItem("videoState", "enabled");
    } else {
        video.style.display = "none";
        disableButton.style.display = "inline";
        enableButton.style.display = "none";
        sessionStorage.setItem("videoState", "disabled");
    }
}

window.onload = function () {
    var videoState = sessionStorage.getItem("videoState");
    if (videoState === "disabled") {
        document.getElementById("background-video").style.display = "none";
        document.getElementById("disable-video").style.display = "none";
        document.getElementById("enable-video").style.display = "inline";
    }

    const audioPlayer = document.getElementById("audio-player");
    if (sessionStorage.getItem("audioPlaying") === "true") {
        audioPlayer.play();
    }

    document.addEventListener("click", function playAudio() {
        audioPlayer.play();
        sessionStorage.setItem("audioPlaying", "true");
        document.removeEventListener("click", playAudio);
    });

   
    fetchInstagramPosts();
};

function fetchInstagramPosts() {
    const accessToken = "YOUR_INSTAGRAM_ACCESS_TOKEN";
    const userId = "YOUR_INSTAGRAM_USER_ID";
    const url = `https://graph.instagram.com/${userId}/media?fields=id,caption,media_type,media_url&access_token=${accessToken}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            const container = document.getElementById("instagram-posts");
            container.innerHTML = ""; // Clear existing content
            data.data.forEach((post) => {
                const div = document.createElement("div");
                div.className = "instagram-post";
                if (post.media_type === "IMAGE" || post.media_type === "CAROUSEL_ALBUM") {
                    div.innerHTML = `<img src="${post.media_url}" alt="${post.caption || "Instagram Post"}">`;
                } else if (post.media_type === "VIDEO") {
                    div.innerHTML = `<video controls><source src="${post.media_url}" type="video/mp4"></video>`;
                }
                container.appendChild(div);
            });
        })
        .catch((error) => console.error("Error fetching Instagram posts:", error));
}

function showContent(type) {
    const contentTitle = document.getElementById('content-title');
    const contentDescription = document.getElementById('content-description');

    if (type === 'whoAmI') {
        contentTitle.textContent = 'Who Am I?';
        contentDescription.textContent = "I'm a passionate individual who loves coding, exploring new technologies, and sharing knowledge with others.";
    } else if (type === 'myHobby') {
        contentTitle.textContent = 'My Hobby';
        contentDescription.textContent = "I enjoy painting, hiking, and playing video games. These activities help me stay creative and balanced.";
    } else if (type === 'whyThisTheme') {
        contentTitle.textContent = 'Why This Theme?';
        contentDescription.textContent = "This theme reflects my love for modern, clean design, and immersive experiences, blending aesthetics with functionality.";
    } else {
        contentTitle.textContent = 'Welcome';
        contentDescription.textContent = 'Click on the buttons on the left to learn more about me!';
    }
}
