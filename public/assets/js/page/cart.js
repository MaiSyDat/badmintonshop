document.addEventListener("DOMContentLoaded", function () {
    const plusButtons = document.querySelectorAll(".ss_cart-plus");
    const minusButtons = document.querySelectorAll(".ss_cart-minus");

    plusButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const container = btn.closest(".ss_cart-quantity-control");
            const input = container.querySelector(".ss_cart-qty-input");
            const productId = container.getAttribute("data-id");
            let quantity = parseInt(input.value);

            if (!isNaN(quantity)) {
                quantity += 1;
                updateCart(productId, quantity, input);
            }
        });
    });

    minusButtons.forEach((btn) => {
        btn.addEventListener("click", function () {
            const container = btn.closest(".ss_cart-quantity-control");
            const input = container.querySelector(".ss_cart-qty-input");
            const productId = container.getAttribute("data-id");
            let quantity = parseInt(input.value);

            if (!isNaN(quantity) && quantity > 1) {
                quantity -= 1;
                updateCart(productId, quantity, input);
            }
        });
    });
});

function formatCurrency(number) {
    return number.toLocaleString("vi-VN");
}

function updateCart(productId, quantity, inputElement) {
    fetch(`/cart/update/${productId}/${quantity}`, {
        method: "GET",
        headers: {
            "X-Requested-With": "XMLHttpRequest",
        },
    })
        .then((res) => res.json())
        .then((data) => {
            if (data.success) {
                inputElement.value = quantity;

                //Cập nhật tổng giá từng sản phẩm
                const itemTotalElement = document.querySelector(
                    `.ss_cart-product-total[data-id="${productId}"] .item-total`
                );
                itemTotalElement.textContent = formatCurrency(data.item_total);

                // Cập nhật tổng toàn giỏ hàng
                const cartTotal = document.getElementById("cart-total");
                cartTotal.textContent = "₫" + formatCurrency(data.cart_total);

                //Nếu có mã giảm giá, cập nhật tổng sau giảm
                const discountElement = document.getElementById(
                    "cart-discount-amount"
                );
                const finalTotalElement =
                    document.getElementById("cart-final-total");

                if (discountElement && finalTotalElement) {
                    let discount =
                        parseFloat(
                            discountElement.getAttribute("data-discount")
                        ) || 0;
                    const final = data.cart_total - discount;
                    finalTotalElement.textContent = "₫" + formatCurrency(final);
                }
            }
        })
        .catch((err) => console.error("Lỗi khi cập nhật:", err));
}
