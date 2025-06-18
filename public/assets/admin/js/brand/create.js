document.addEventListener('DOMContentLoaded', function() {
    // Auto-generate slug from brand name
    const brandNameInput = document.getElementById('brand_name');
    const brandSlugInput = document.getElementById('brand_slug');

    if (brandNameInput && brandSlugInput) {
        brandNameInput.addEventListener('input', function() {
            const slug = this.value
                .toLowerCase()
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '')
                .replace(/[đĐ]/g, 'd')
                .replace(/([^0-9a-z-\s])/g, '')
                .replace(/(\s+)/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
            brandSlugInput.value = slug;
        });
    }

    // Logo preview
    const logoInput = document.getElementById('brand_logo');
    const logoPreview = document.getElementById('logoPreview');

    if (logoInput && logoPreview) {
        logoInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreview.innerHTML = `<img src="${e.target.result}" alt="Logo preview">`;
                };
                reader.readAsDataURL(file);
            } else {
                logoPreview.innerHTML = '<i class="bi bi-image text-muted" style="font-size: 3rem;"></i>';
            }
        });
    }

    // Form validation
    const form = document.getElementById('addBrandForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    }
}); 