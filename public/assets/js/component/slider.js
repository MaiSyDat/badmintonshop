// Slider functionality
const sliderTopContainer = document.getElementById("sliderTopContainer");
const sliderTopSlides = document.querySelectorAll(".slider_top_slide");
let currentSlide = 0;
let sliderTopInterval;
let isPaused = false;

// Function to show a specific slide
function showSlide(index) {
    // Hide all slides
    sliderTopSlides.forEach((slide) => {
        slide.classList.remove("slider_top_active");
    });

    // Show the selected slide
    sliderTopSlides[index].classList.add("slider_top_active");

    // Update current slide index
    currentSlide = index;
}

// Function to show the next slide
function nextSlide() {
    if (isPaused) return;

    // Calculate next slide index
    let nextIndex = currentSlide + 1;

    // If we've reached the end, go back to the first slide
    if (nextIndex >= sliderTopSlides.length) {
        nextIndex = 0;
    }

    // Show the next slide
    showSlide(nextIndex);
}

// Start the slider
function startSlider() {
    // Clear any existing interval
    if (sliderTopInterval) {
        clearInterval(sliderTopInterval);
    }

    // Set a new interval to change slides every 3 seconds
    sliderTopInterval = setInterval(nextSlide, 3000);
}

// Pause the slider
function pauseSlider() {
    isPaused = true;
}

// Resume the slider
function resumeSlider() {
    isPaused = false;
}

// Initialize the slider
function initSlider() {
    // Show the first slide
    showSlide(0);

    // Start the automatic slide change
    startSlider();

    // Optional: Pause on hover
    sliderTopContainer.addEventListener("mouseenter", pauseSlider);
    sliderTopContainer.addEventListener("mouseleave", resumeSlider);
}

// Hide loading overlay when images are loaded
window.addEventListener("load", function () {
    const loading = document.getElementById("sliderTopLoading");
    loading.classList.add("slider_top_loaded");

    // Initialize the slider after loading
    initSlider();
});

// Preload images for better performance
const slider_top_images = Array.from(
    document.querySelectorAll(".slider_top_image")
).map((img) => img.src);

function slider_top_preloadImages() {
    slider_top_images.forEach((src) => {
        const img = new Image();
        img.src = src;
    });
}

// Start preloading
slider_top_preloadImages();
