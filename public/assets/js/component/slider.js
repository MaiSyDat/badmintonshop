const video = document.getElementById("introVideo");
const toggleBtn = document.getElementById("toggleSoundBtn");

toggleBtn.addEventListener("click", () => {
    video.muted = !video.muted;
    toggleBtn.textContent = video.muted ? "🔇" : "🔊";
});
