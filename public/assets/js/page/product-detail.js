const ProductDetail = {
    changeImage: function (thumbnail) {
        const mainImage = document.getElementById("productDetailMainImage");

        // Cập nhật ảnh chính
        mainImage.src = thumbnail.src;
        mainImage.alt = thumbnail.alt;

        // Highlight thumbnail đang chọn
        document
            .querySelectorAll(".product-detail-gallery__thumbnail")
            .forEach((img) =>
                img.classList.remove(
                    "product-detail-gallery__thumbnail--active"
                )
            );

        thumbnail.classList.add("product-detail-gallery__thumbnail--active");
    },

    init: function () {
        // Tự set active cho thumbnail đầu tiên nếu chưa có
        const thumbnails = document.querySelectorAll(
            ".product-detail-gallery__thumbnail"
        );
        if (thumbnails.length) {
            this.changeImage(thumbnails[0]);
        }
    },
};

document.addEventListener("DOMContentLoaded", () => ProductDetail.init());

// quantity
document.addEventListener("DOMContentLoaded", function () {
    const quantityInput = document.getElementById("quantityInput");
    const buttons = document.querySelectorAll(".quantity-btn");

    buttons.forEach((btn) => {
        btn.addEventListener("click", function () {
            let current = parseInt(quantityInput.value) || 1;
            if (this.textContent === "+") {
                quantityInput.value = current + 1;
            } else if (this.textContent === "-" && current > 1) {
                quantityInput.value = current - 1;
            }
        });
    });
});
