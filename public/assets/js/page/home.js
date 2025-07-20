// =============================
// 1. NÚT YÊU THÍCH (wishlist)
// =============================
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".wishlist-btn").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-product-id");
            const svg = this.querySelector("svg");
            const isActive = this.classList.contains("active");
            const url = isActive ? "/wishlist/remove" : "/wishlist/add";

            fetch(url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ product_id: productId }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        this.classList.toggle("active");
                        svg.style.fill = this.classList.contains("active")
                            ? "red"
                            : "none";
                        svg.style.stroke = this.classList.contains("active")
                            ? "red"
                            : "#666";
                    } else {
                        alert("Thao tác không thành công.");
                    }
                })
                .catch(() => {
                    alert("Đăng nhập để yêu thích sản phẩm.");
                });
        });
    });
});

// =============================
// 2. CHỌN MÀU SẢN PHẨM
// =============================
document.querySelectorAll(".color-dot").forEach((dot) => {
    dot.addEventListener("click", function () {
        this.parentNode.querySelectorAll(".color-dot").forEach((d) => {
            d.style.borderColor = "#e0e0e0";
            d.style.borderWidth = "2px";
        });

        this.style.borderColor = "#333";
        this.style.borderWidth = "3px";
    });
});

// =============================
// 4. SLIDER TRONG TRANG HOME
// =============================
let currentHomeSlideIndex = 0;
let homeSlides = document.querySelectorAll(".slide");
let homeDots = document.querySelectorAll(".dot");
let sliderWrapper = document.getElementById("sliderWrapper");

function showHomeSlide(index) {
    homeDots.forEach((dot) => dot.classList.remove("active"));
    if (homeDots[index]) {
        homeDots[index].classList.add("active");
    }

    sliderWrapper.style.transform = `translateX(-${index * 100}%)`;
    currentHomeSlideIndex = index;
}

function changeHomeSlide(direction) {
    currentHomeSlideIndex += direction;

    if (currentHomeSlideIndex >= homeSlides.length) {
        currentHomeSlideIndex = 0;
    }

    if (currentHomeSlideIndex < 0) {
        currentHomeSlideIndex = homeSlides.length - 1;
    }

    showHomeSlide(currentHomeSlideIndex);
}

function currentHomeSlide(index) {
    showHomeSlide(index);
}

setInterval(() => {
    changeHomeSlide(1);
}, 3000);

document
    .querySelector(".slider-nav.prev")
    ?.addEventListener("click", () => changeHomeSlide(-1));
document
    .querySelector(".slider-nav.next")
    ?.addEventListener("click", () => changeHomeSlide(1));

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
        e.stopPropagation();
        const brandName =
            this.closest(".slide").querySelector(".brand-name").textContent;
        alert(`Khám phá sản phẩm ${brandName}!`);
    });
});
