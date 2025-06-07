// Form validation and interactions
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("addUserForm");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirm_password");
    const usernameInput = document.getElementById("username");
    const fullNameInput = document.getElementById("full_name");
    const avatarPreview = document.getElementById("avatarPreview");
    const avatarInput = document.getElementById("avatar");
    const isActiveSwitch = document.getElementById("is_active");

    // Password strength indicator
    passwordInput.addEventListener("input", function () {
        const password = this.value;
        const strengthBar = document.getElementById("passwordStrength");
        let strength = 0;

        if (password.length >= 8) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^a-zA-Z\d]/.test(password)) strength++;

        strengthBar.className = "password-strength";
        if (strength >= 3) {
            strengthBar.classList.add("strength-strong");
        } else if (strength >= 2) {
            strengthBar.classList.add("strength-medium");
        } else if (strength >= 1) {
            strengthBar.classList.add("strength-weak");
        }
    });

    // Confirm password validation
    confirmPasswordInput.addEventListener("input", function () {
        if (this.value !== passwordInput.value) {
            this.setCustomValidity("Mật khẩu xác nhận không khớp");
        } else {
            this.setCustomValidity("");
        }
    });

    // Username validation (no spaces, special characters)
    usernameInput.addEventListener("input", function () {
        const username = this.value;
        if (!/^[a-zA-Z0-9_]+$/.test(username) && username !== "") {
            this.setCustomValidity(
                "Tên đăng nhập chỉ được chứa chữ cái, số và dấu gạch dưới"
            );
        } else {
            this.setCustomValidity("");
        }
    });

    // Auto-generate username from full name
    fullNameInput.addEventListener("input", function () {
        if (!usernameInput.value) {
            const fullName = this.value;
            const username = fullName
                .toLowerCase()
                .replace(/[àáạảãâầấậẩẫăằắặẳẵ]/g, "a")
                .replace(/[èéẹẻẽêềếệểễ]/g, "e")
                .replace(/[ìíịỉĩ]/g, "i")
                .replace(/[òóọỏõôồốộổỗơờớợởỡ]/g, "o")
                .replace(/[ùúụủũưừứựửữ]/g, "u")
                .replace(/[ỳýỵỷỹ]/g, "y")
                .replace(/đ/g, "d")
                .replace(/[^a-z0-9]/g, "")
                .substring(0, 20);
            usernameInput.value = username;
        }

        // Update avatar preview
        updateAvatarPreview();
    });

    // Avatar preview
    avatarInput.addEventListener("change", function (e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                avatarPreview.innerHTML = `<img src="${e.target.result}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
            };
            reader.readAsDataURL(file);
        }
    });

    // Update avatar preview with initials
    function updateAvatarPreview() {
        if (!avatarInput.files[0]) {
            const fullName = fullNameInput.value || usernameInput.value;
            if (fullName) {
                const initials = fullName
                    .split(" ")
                    .map((word) => word.charAt(0))
                    .join("")
                    .toUpperCase()
                    .substring(0, 2);
                avatarPreview.innerHTML =
                    initials || '<i class="bi bi-person"></i>';
            } else {
                avatarPreview.innerHTML = '<i class="bi bi-person"></i>';
            }
        }
    }

    // Active status switch
    isActiveSwitch.addEventListener("change", function () {
        const label = this.nextElementSibling.querySelector(".badge");
        if (this.checked) {
            label.className = "badge bg-success me-2";
            label.textContent = "Kích hoạt";
        } else {
            label.className = "badge bg-danger me-2";
            label.textContent = "Vô hiệu hóa";
        }
    });

    // Form submission
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        if (form.checkValidity()) {
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML =
                '<span class="spinner-border spinner-border-sm me-2"></span>Đang xử lý...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;

                // Show success modal
                const successModal = new bootstrap.Modal(
                    document.getElementById("successModal")
                );
                successModal.show();
            }, 2000);
        } else {
            form.classList.add("was-validated");
        }
    });

    // Reset form
    form.addEventListener("reset", function () {
        form.classList.remove("was-validated");
        document.getElementById("passwordStrength").className =
            "password-strength";
        avatarPreview.innerHTML = '<i class="bi bi-person"></i>';
        isActiveSwitch.checked = true;
        isActiveSwitch.dispatchEvent(new Event("change"));
    });
});
