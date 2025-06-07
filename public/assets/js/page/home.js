// =============================
// 1. NÚT YÊU THÍCH (wishlist)
// =============================
document.querySelectorAll(".wishlist-btn").forEach((btn) => {
    btn.addEventListener("click", function () {
        const svg = this.querySelector("svg");
        if (svg.style.fill === "red") {
            svg.style.fill = "none";
            svg.style.stroke = "#666"; // Màu khi bỏ yêu thích
        } else {
            svg.style.fill = "red";
            svg.style.stroke = "red"; // Màu khi đã yêu thích
        }
    });
});

// =============================
// 2. CHỌN MÀU SẢN PHẨM
// =============================
document.querySelectorAll(".color-dot").forEach((dot) => {
    dot.addEventListener("click", function () {
        // Reset tất cả chấm màu khác về viền mặc định
        this.parentNode.querySelectorAll(".color-dot").forEach((d) => {
            d.style.borderColor = "#e0e0e0";
            d.style.borderWidth = "2px";
        });

        // Chấm màu được chọn sẽ có viền đậm hơn
        this.style.borderColor = "#333";
        this.style.borderWidth = "3px";
    });
});

// =============================
// 3. LOAD THÊM SẢN PHẨM
// =============================
document
    .querySelector(".load-more-btn")
    ?.addEventListener("click", function () {
        alert("Đang tải thêm vợt cầu lông...");
    });

// =============================
// 4. SLIDER TỰ ĐỘNG VÀ NÚT ĐIỀU HƯỚNG
// =============================

let currentSlideIndex = 0;
let slides = document.querySelectorAll(".slide");
let dots = document.querySelectorAll(".dot");
let sliderWrapper = document.getElementById("sliderWrapper");

// Hiển thị slide theo chỉ số
function showSlide(index) {
    // Xóa class active của tất cả các dot
    dots.forEach((dot) => dot.classList.remove("active"));

    // Thêm class active vào dot hiện tại
    if (dots[index]) {
        dots[index].classList.add("active");
    }

    // Dịch chuyển slide
    sliderWrapper.style.transform = `translateX(-${index * 100}%)`;
    currentSlideIndex = index;
}

// Chuyển slide theo hướng trái (-1) hoặc phải (+1)
// Cập nhật trong hàm changeSlide()
function changeSlide(direction) {
    currentSlideIndex += direction;

    // Nếu vượt slide cuối thì quay lại slide đầu
    if (currentSlideIndex >= slides.length) {
        currentSlideIndex = 0;
    }

    // Nếu nhỏ hơn slide đầu thì về slide cuối
    if (currentSlideIndex < 0) {
        currentSlideIndex = slides.length - 1;
    }

    showSlide(currentSlideIndex);
}

// Hiển thị slide cụ thể theo chỉ số dot (nút tròn)
function currentSlide(index) {
    showSlide(index - 1);
}

// Auto chạy slide sau mỗi 5 giây
setInterval(() => {
    changeSlide(1);
}, 3000);

// =============================
// 5. NÚT ĐIỀU HƯỚNG SLIDER (gắn từ JS, không dùng onclick)
// =============================
document
    .querySelector(".slider-nav.prev")
    ?.addEventListener("click", () => changeSlide(-1));
document
    .querySelector(".slider-nav.next")
    ?.addEventListener("click", () => changeSlide(1));

// =============================
// 6. CLICK VÀO THẺ DANH MỤC
// =============================
document.querySelectorAll(".category-card").forEach((card) => {
    card.addEventListener("click", function () {
        const brandName = this.querySelector(".category-name").textContent;
        alert(`Đang chuyển đến trang ${brandName}...`);
    });
});

// =============================
// 7. NÚT KHÁM PHÁ NHÃN HIỆU
// =============================
document.querySelectorAll(".brand-btn").forEach((btn) => {
    btn.addEventListener("click", function (e) {
        e.stopPropagation(); // Ngăn sự kiện lan sang phần tử cha
        const brandName =
            this.closest(".slide").querySelector(".brand-name").textContent;
        alert(`Khám phá sản phẩm ${brandName}!`);
    });
});
