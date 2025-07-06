document.addEventListener("DOMContentLoaded", function () {
    const quantityControls = document.querySelectorAll(
        ".ss_cart-quantity-control"
    );

    quantityControls.forEach((control) => {
        const minusBtn = control.querySelector(".ss_cart-minus");
        const plusBtn = control.querySelector(".ss_cart-plus");
        const input = control.querySelector(".ss_cart-qty-input");
        const productId = control.getAttribute("data-id");

        minusBtn.addEventListener("click", function () {
            let quantity = parseInt(input.value);
            if (quantity > 1) {
                quantity--;
                updateCart(productId, quantity, input);
            }
        });

        plusBtn.addEventListener("click", function () {
            let quantity = parseInt(input.value);
            quantity++;
            updateCart(productId, quantity, input);
        });
    });

    function formatCurrency(number) {
        return new Intl.NumberFormat("vi-VN").format(number);
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

                    // Cập nhật tổng giá từng sản phẩm
                    const itemTotalElement = document.querySelector(
                        `.ss_cart-product-total[data-id="${productId}"] .item-total`
                    );
                    itemTotalElement.textContent = formatCurrency(
                        data.item_total
                    );

                    // Cập nhật tổng toàn giỏ hàng
                    const cartTotal = document.getElementById("cart-total");
                    cartTotal.textContent =
                        "₫" + formatCurrency(data.cart_total);
                }
            })
            .catch((err) => console.error("Lỗi khi cập nhật:", err));
    }
});
